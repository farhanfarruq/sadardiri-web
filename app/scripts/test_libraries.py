import sys

try:
    # Coba impor library yang dibutuhkan
    import pandas as pd
    import sklearn
    
    # Jika berhasil, cetak pesan sukses beserta versi library
    print("SUKSES! Semua library berhasil diimpor.")
    print(f"- Pandas versi: {pd.__version__}")
    print(f"- Scikit-learn versi: {sklearn.__version__}")
    
except ImportError as e:
    # Jika gagal, cetak pesan error yang jelas
    print(f"GAGAL! Library tidak ditemukan.")
    print(f"Error: {e}")
    print("\nSilakan jalankan perintah ini di CMD Anda:")
    print("pip install pandas scikit-learn")
    
except Exception as e:
    print(f"Terjadi error tidak terduga: {e}")

