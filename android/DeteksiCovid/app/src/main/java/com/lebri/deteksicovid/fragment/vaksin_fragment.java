package com.lebri.deteksicovid.fragment;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.lebri.deteksicovid.API.APIService;
import com.lebri.deteksicovid.API.NoConnectivityException;
import com.lebri.deteksicovid.R;
import com.lebri.deteksicovid.adapter.VaksinAdapter;
import com.lebri.deteksicovid.config.Constants;
import com.lebri.deteksicovid.model.GetVaksin;
import com.lebri.deteksicovid.model.VaksinModel;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class vaksin_fragment extends Fragment {
    private RecyclerView gridView;
    private VaksinAdapter vaksinAdapter;
    private List<VaksinModel> daftarVaksin;
    private ProgressDialog progressDialog;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View myview = inflater.inflate(R.layout.fragment_vaksin, container, false);
        dataInit(myview);
        setupRecyclerView();
        SharedPreferences sharedPreferences = requireContext().getSharedPreferences(
            Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        setData(getContext(),idUser);
        return myview;
    }

    private void dataInit(View mView){
        progressDialog = ProgressDialog.show(getContext(), "", "Loading.....", true, false);
        gridView = mView.findViewById(R.id.rcRiwayat);
    }

    private void setData(Context context, String idUser) {
        try{
            Call<GetVaksin> call = APIService.Factory.create(context).dataVaksin(idUser);
            call.enqueue(new Callback<GetVaksin>() {
                @Override
                public void onResponse(Call<GetVaksin> call, Response<GetVaksin> response) {
                    progressDialog.dismiss();
                    if(response.isSuccessful()) {
                        if (response.body() != null) {
                            daftarVaksin = response.body().getDaftarVaksin();
                            vaksinAdapter.replaceData(daftarVaksin);
                        }
                    }
                }

                @Override
                public void onFailure(Call<GetVaksin> call, Throwable t) {
                    progressDialog.dismiss();
                    if(t instanceof NoConnectivityException) {
                        pesan("Offline, cek koneksi internet anda!");
                    }
                }
            });
        }catch (Exception e){
            progressDialog.dismiss();
            e.printStackTrace();
        }
    }

    private void setupRecyclerView() {
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getActivity()){
            @Override
            public RecyclerView.LayoutParams generateDefaultLayoutParams() {
                return new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
            }
        };
        vaksinAdapter = new VaksinAdapter(new ArrayList<>());
        gridView.setLayoutManager(linearLayoutManager);
        gridView.setAdapter(vaksinAdapter);
    }

    public void pesan(String msg)
    {
        Toast.makeText(requireContext(), msg, Toast.LENGTH_LONG).show();
    }
}
