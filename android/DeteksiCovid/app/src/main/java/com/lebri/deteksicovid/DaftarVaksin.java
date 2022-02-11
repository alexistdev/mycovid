package com.lebri.deteksicovid;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.lebri.deteksicovid.API.APIService;
import com.lebri.deteksicovid.API.NoConnectivityException;
import com.lebri.deteksicovid.config.Constants;
import com.lebri.deteksicovid.model.VaksinModel;
import com.lebri.deteksicovid.ui.Deteksi;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class DaftarVaksin extends AppCompatActivity {
    private EditText edNama,edNik,edPhone;
    private Button mSimpan;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_daftarvaksin);
        init();
        mSimpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String nama = edNama.getText().toString();
                String nik = edNik.getText().toString();
                String phone = edPhone.getText().toString();
                if (nama.trim().length() > 0 && nik.trim().length() > 0 && phone.trim().length() > 0) {
                    pendaftaran(nama,nik,phone);
                } else {
                    pesan("Semua kolom harus diisi!");
                }
            }
        });
	}

    private void pendaftaran(final String nama, final String nik, final String phone){
	    try{
            SharedPreferences sharedPreferences = this.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
            String idUser = sharedPreferences.getString("idUser", "");
            Call<VaksinModel> call = APIService.Factory.create(getApplicationContext()).daftarVaksin(idUser,nama,nik,phone);
            call.enqueue(new Callback<VaksinModel>() {
                @Override
                public void onResponse(Call<VaksinModel> call, Response<VaksinModel> response) {
                    Intent intent = new Intent(DaftarVaksin.this, MainActivity.class);
                    startActivity(intent);
                    finish();
                    pesan("ANda berhasil mendaftar vaksin!");
                }

                @Override
                public void onFailure(Call<VaksinModel> call, Throwable t) {
                    if(t instanceof NoConnectivityException) {
                        pesan("Offline, cek koneksi internet anda!");
                    }
                }
            });
        }catch (Exception e){
            e.printStackTrace();
            pesan(e.getMessage());
        }
    }

    public void init() {
        edNama = findViewById(R.id.txt_nama);
        edNik = findViewById(R.id.txt_nik);
        edPhone = findViewById(R.id.txt_phone);
        mSimpan = findViewById(R.id.btn_simpan);
    }

    public void pesan(String msg)
    {
        Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
    }
}
