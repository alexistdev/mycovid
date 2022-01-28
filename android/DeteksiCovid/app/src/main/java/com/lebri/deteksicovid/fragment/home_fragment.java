package com.lebri.deteksicovid.fragment;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.cardview.widget.CardView;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.lebri.deteksicovid.DaftarVaksin;
import com.lebri.deteksicovid.R;
import com.lebri.deteksicovid.config.Constants;
import com.lebri.deteksicovid.ui.Deteksi;
import com.lebri.deteksicovid.ui.Informasi;
import com.lebri.deteksicovid.ui.Jadwalvaksin;


public class home_fragment extends Fragment {
    private CardView mDeteksi,mJadwalVaksin,mInformasi,mDaftarVaksin;
    private ProgressDialog pDialog;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View myview = inflater.inflate(R.layout.fragment_home, container, false);
        init(myview);
        SharedPreferences sharedPreferences = requireContext().getSharedPreferences(
            Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        mDeteksi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), Deteksi.class);
                startActivity(intent);
            }
        });
        mJadwalVaksin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getActivity(), Jadwalvaksin.class);
                startActivity(intent);
            }
        });
        mInformasi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getActivity(), Informasi.class);
                startActivity(intent);
            }
        });
        mDaftarVaksin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getActivity(), DaftarVaksin.class);
                startActivity(intent);
            }
        });
        return myview;
    }



    public void init(View view){
        mDeteksi = view.findViewById(R.id.btndeteksi);
        mJadwalVaksin = view.findViewById(R.id.cd_jadwalvaksin);
        mInformasi = view.findViewById(R.id.cd_informasi);
        mDaftarVaksin = view.findViewById(R.id.cd_daftarvaksin);
        pDialog = new ProgressDialog(getContext());
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
        Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
    }

}
