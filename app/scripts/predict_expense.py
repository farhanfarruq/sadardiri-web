# Versi baru yang hanya menggunakan pandas dan numpy
import pandas as pd
import numpy as np # Menggunakan numpy untuk perhitungan
import sys
import json
import os

def predict_monthly_expense():
    """
    Fungsi prediksi yang dihitung manual menggunakan numpy, tanpa scikit-learn.
    """
    try:
        input_data = sys.stdin.read()
        transactions = json.loads(input_data)
        
        if not transactions:
            print(json.dumps({"error": "Tidak ada data transaksi untuk dianalisis."}))
            return

        df = pd.DataFrame(transactions)
        df['date'] = pd.to_datetime(df['date'])
        # Pastikan kolom amount adalah numerik
        df['amount'] = pd.to_numeric(df['amount'])
        df = df[df['type'] == 'expense']

        if df.empty:
            print(json.dumps({"error": "Tidak ada data pengeluaran (expense) yang ditemukan."}))
            return

        df['month'] = df['date'].dt.to_period('M')
        monthly_expenses = df.groupby('month')['amount'].sum().reset_index()
        
        if len(monthly_expenses) < 2:
            print(json.dumps({
                "error": "Data tidak cukup untuk prediksi.",
                "prediction_text": "Butuh setidaknya 2 bulan data pengeluaran untuk bisa membuat prediksi."
            }))
            return

        # ---- PERHITUNGAN REGRESI LINEAR MANUAL DENGAN NUMPY ----
        # Konversi bulan ke angka sederhana (0, 1, 2, ...)
        X = np.arange(len(monthly_expenses)) 
        y = monthly_expenses['amount'].values

        # Hitung rata-rata
        x_mean = np.mean(X)
        y_mean = np.mean(y)

        # Hitung slope (m) dan intercept (b)
        numerator = np.sum((X - x_mean) * (y - y_mean))
        denominator = np.sum((X - x_mean) ** 2)
        
        # Hindari pembagian dengan nol jika data tidak bervariasi
        if denominator == 0:
            slope = 0
        else:
            slope = numerator / denominator
        
        intercept = y_mean - (slope * x_mean)
        # ---------------------------------------------------------

        # Buat prediksi untuk bulan berikutnya
        next_month_index = len(monthly_expenses)
        predicted_expense = (slope * next_month_index) + intercept

        last_month_expense = y[-1]
        average_expense = y_mean

        if predicted_expense > average_expense * 1.1:
            prediction_text = "Hati-hati, bulan depan kamu berpotensi overbudget! 😟"
        else:
            prediction_text = "Pengeluaran bulan depanmu tampaknya akan aman terkendali. 👍"

        result = {
            "predicted_expense": round(predicted_expense, 2),
            "last_month_expense": float(last_month_expense),
            "average_expense": round(average_expense, 2),
            "prediction_text": prediction_text
        }
        print(json.dumps(result))

    except Exception as e:
        # Tambahkan nama file dan nomor baris ke error untuk debug lebih mudah
        exc_type, exc_obj, exc_tb = sys.exc_info()
        fname = os.path.split(exc_tb.tb_frame.f_code.co_filename)[1]
        error_details = f"Error: {e} in {fname} at line {exc_tb.tb_lineno}"
        print(json.dumps({"error": "Terjadi masalah pada script Python.", "details": error_details}))

if __name__ == "__main__":
    predict_monthly_expense()
