package com.lebri.deteksicovid.adapter;

import android.annotation.SuppressLint;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.lebri.deteksicovid.R;
import com.lebri.deteksicovid.model.VaksinModel;

import java.util.List;

public class VaksinAdapter extends RecyclerView.Adapter<VaksinAdapter.MyVaksinHolder> {
    public List<VaksinModel> mVaksinList;

    public VaksinAdapter(List<VaksinModel> mVaksinList) {
        this.mVaksinList = mVaksinList;
    }

    @NonNull
    @Override
    public VaksinAdapter.MyVaksinHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.singgle_list_vaksin, parent, false);
        VaksinAdapter.MyVaksinHolder holder;
        holder = new VaksinAdapter.MyVaksinHolder(mView);
        return holder;
    }
    @Override
    public void onBindViewHolder (@NonNull VaksinAdapter.MyVaksinHolder holder, final int position){
        holder.mNama.setText(mVaksinList.get(position).getNamaLengkap());
        holder.mTanggal.setText("Tanggal Daftar: "+ mVaksinList.get(position).getTanggal());
    }

    public int getItemCount () {
        return mVaksinList.size();
    }

    @SuppressLint("NotifyDataSetChanged")
    public void replaceData(List<VaksinModel> dataVaksin) {
        this.mVaksinList = dataVaksin;
        notifyDataSetChanged();
    }

    public static class MyVaksinHolder extends RecyclerView.ViewHolder {
        private final TextView mNama,mTanggal;

        MyVaksinHolder(@NonNull View itemView) {
            super(itemView);
            mNama = itemView.findViewById(R.id.txt_nama);
            mTanggal = itemView.findViewById(R.id.txt_tanggal);
        }
    }


}
