package com.lebri.deteksicovid.ui;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.lebri.deteksicovid.API.APIService;
import com.lebri.deteksicovid.API.NoConnectivityException;
import com.lebri.deteksicovid.R;
import com.lebri.deteksicovid.model.PertanyaanModel;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Deteksi extends AppCompatActivity {
    private TextView mPertanyaan;
    private ProgressDialog pDialog;
    private Button mYa,mGayakin,mTidak;
    private String mNamaGejala;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_deteksi);
        Deteksi.this.setTitle("Deteksi Covid19");
        init();
        dapatPertanyaan("1");

    }

    /**
     *
     * @param idUser = idUser
     * @param jawaban = jika 1 maka ya , jika 2 maka tidak yakin, jika 3 maka tidak
     */
    public void simpanJawaban(String idUser, int jawaban){

    }

    public void dapatPertanyaan(String idUser)
    {
        this.showDialog();
        try{
            Call<PertanyaanModel> pertanyaan= APIService.Factory.create(this).dataPertanyaan(idUser);
            pertanyaan.enqueue(new Callback<PertanyaanModel>() {
                @EverythingIsNonNull
                @Override
                public void onResponse(Call<PertanyaanModel> call, Response<PertanyaanModel> response) {
                    hideDialog();
                    if(response.isSuccessful()) {
                        if (response.body() != null) {
                            mPertanyaan.setText(response.body().getNamaGejala()+"?");
                            mYa.setOnClickListener(new View.OnClickListener() {
                                @Override
                                public void onClick(View v) {
                                    pesan("ya");
                                }

                            });
                        }
                    }
                }
                @EverythingIsNonNull
                @Override
                public void onFailure(Call<PertanyaanModel> call, Throwable t) {
                    hideDialog();
                    if(t instanceof NoConnectivityException) {
                        pesan("Offline, cek koneksi internet anda!");
                    }
                }
            });
        }catch (Exception e){
            this.hideDialog();
            e.printStackTrace();
            pesan(e.getMessage());
        }
    }

    public void init() {
        mPertanyaan = findViewById(R.id.text_pertanyaan);
        mYa = findViewById(R.id.btn_ya);
        mGayakin = findViewById(R.id.btn_gayakin);
        mTidak = findViewById(R.id.btn_tidak);

        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");
    }

    private void showDialog(){
        if(!pDialog.isShowing()){
            pDialog.show();
        }
    }

    private void hideDialog(){
        if(pDialog.isShowing()){
            pDialog.dismiss();
        }
    }

    public void pesan(String msg)
    {
        Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
    }
}
