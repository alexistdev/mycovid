package com.lebri.deteksicovid.ui;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.lebri.deteksicovid.API.APIService;
import com.lebri.deteksicovid.API.NoConnectivityException;
import com.lebri.deteksicovid.MainActivity;
import com.lebri.deteksicovid.R;
import com.lebri.deteksicovid.config.Constants;
import com.lebri.deteksicovid.model.HasildeteksiModel;
import com.lebri.deteksicovid.model.PertanyaanModel;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Deteksi extends AppCompatActivity {
    private TextView mPertanyaan,mPenyakit,mProsentase;
    private ProgressDialog pDialog;
    private Button mYa,mGayakin,mTidak,mUlangi;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_deteksi);
        Deteksi.this.setTitle("Deteksi Covid19");
        init();
        SharedPreferences sharedPreferences = this.getSharedPreferences(
            Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        dapatPertanyaan(idUser);


    }

    private void hapusJawaban(String idUser)
    {
        try{
            Call<HasildeteksiModel> hapusJawaban = APIService.Factory.create(this).hapusData(idUser);
            hapusJawaban.enqueue(new Callback<HasildeteksiModel>() {
                @EverythingIsNonNull
                @Override
                public void onResponse(Call<HasildeteksiModel> call, Response<HasildeteksiModel> response) {
                    Intent intent = new Intent(Deteksi.this, MainActivity.class);
                    startActivity(intent);
                    finish();
                }
                @EverythingIsNonNull
                @Override
                public void onFailure(Call<HasildeteksiModel> call, Throwable t) {
                    if(t instanceof NoConnectivityException) {
                        pesan("Offline, cek koneksi internet anda!");
                    }
                }
            });
        } catch (Exception e){
            e.printStackTrace();
            pesan(e.getMessage());
        }
    }

    /**
     *
     * @param idUser = idUser
     * @param jawaban = jika 1 maka ya , jika 2 maka tidak yakin, jika 3 maka tidak
     * @param idGejala = idGejala
     */
    private void simpanJawaban(String idUser, int jawaban, int idGejala){

        String cfUser = "0";
        if(jawaban == 1){
            cfUser = "0.8";
        }else if(jawaban == 2){
            cfUser = "0.4";
        }else{
            cfUser = "0.2";
        }

        try{
            Call<PertanyaanModel> jawabanUser= APIService.Factory.create(this).simpanJawaban(idUser,idGejala,cfUser);
            jawabanUser.enqueue(new Callback<PertanyaanModel>() {
                @EverythingIsNonNull
                @Override
                public void onResponse(Call<PertanyaanModel> call, Response<PertanyaanModel> response) {
                    dapatPertanyaan(idUser);
                }
                @EverythingIsNonNull
                @Override
                public void onFailure(Call<PertanyaanModel> call, Throwable t) {
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

    private void selesai(String idUser)
    {
        Call<HasildeteksiModel> hasil= APIService.Factory.create(this).datahasil(idUser);
        hasil.enqueue(new Callback<HasildeteksiModel>() {
            @Override
            public void onResponse(Call<HasildeteksiModel> call, Response<HasildeteksiModel> response) {
                if(response.isSuccessful()) {
                    if (response.body() != null) {
                        mPenyakit.setVisibility(View.VISIBLE);
                        mProsentase.setVisibility(View.VISIBLE);
                        Double nilai = Double.parseDouble(response.body().getPerhitungan());
                        mPertanyaan.setText("Dari hasil perhitungan Anda memiliki gejala penyakit :");
                        mPenyakit.setText(response.body().getPenyakit());
                        mProsentase.setText((String.format("%.2f", nilai * 100))+ "%");
//                        mPertanyaan.setText("Anda memiliki gejala penyakit =" +response.body().getPenyakit() + "dengan prosentase" + (String.format("%.2f", nilai * 100))+ "%");
                        mUlangi.setVisibility(View.VISIBLE);
                        mUlangi.setOnClickListener(new View.OnClickListener() {
                            @Override
                            public void onClick(View view) {
                                hapusJawaban(idUser);

                            }
                        });
                    }
                }
            }

            @Override
            public void onFailure(Call<HasildeteksiModel> call, Throwable t) {
                if(t instanceof NoConnectivityException) {
                    pesan("Offline, cek koneksi internet anda!");
                }
            }
        });
        sembunyikanTombol();
    }

    private void sembunyikanTombol()
    {
        mYa.setVisibility(View.GONE);
        mGayakin.setVisibility(View.GONE);
        mTidak.setVisibility(View.GONE);
    }

    private void dapatPertanyaan(String idUser)
    {
        showDialog();
        try{
            Call<PertanyaanModel> pertanyaan= APIService.Factory.create(this).dataPertanyaan(idUser);
            pertanyaan.enqueue(new Callback<PertanyaanModel>() {

                @Override
                public void onResponse(Call<PertanyaanModel> call, Response<PertanyaanModel> response) {
                    hideDialog();
                    if(response.isSuccessful()) {
                        if (response.body() != null) {

                            mPertanyaan.setText(response.body().getNamaGejala()+"?");
                            if(!response.body().getSelesai()){
                                mYa.setOnClickListener(new View.OnClickListener() {
                                    @Override
                                    public void onClick(View v) {
                                        simpanJawaban(idUser,1,response.body().getIdGejala());
                                    }
                                });
                                mGayakin.setOnClickListener(new View.OnClickListener() {
                                    @Override
                                    public void onClick(View v) {
                                        simpanJawaban(idUser,2,response.body().getIdGejala());
                                    }
                                });
                                mTidak.setOnClickListener(new View.OnClickListener() {
                                    @Override
                                    public void onClick(View v) {
                                        simpanJawaban(idUser,3,response.body().getIdGejala());
                                    }
                                });
                            } else {
                                selesai(idUser);
                            }

                        }
                    }
                }

                @Override
                public void onFailure(Call<PertanyaanModel> call, Throwable t) {
                    hideDialog();
                    if(t instanceof NoConnectivityException) {
                        pesan("Offline, cek koneksi internet anda!");
                    }
                }
            });
        }catch (Exception e){
//            hideDialog();
            e.printStackTrace();
            pesan(e.getMessage());
        }
    }

    public void init() {
        mPertanyaan = findViewById(R.id.text_pertanyaan);
        mYa = findViewById(R.id.btn_ya);
        mGayakin = findViewById(R.id.btn_gayakin);
        mTidak = findViewById(R.id.btn_tidak);
        mUlangi = findViewById(R.id.btn_ulangi);
        mPenyakit = findViewById(R.id.txt_penyakit);
        mProsentase = findViewById(R.id.txt_prosentase);
        mPenyakit.setVisibility(View.GONE);
        mProsentase.setVisibility(View.GONE);
        mUlangi.setVisibility(View.GONE);
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
