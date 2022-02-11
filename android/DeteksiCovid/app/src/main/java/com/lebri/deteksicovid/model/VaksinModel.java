package com.lebri.deteksicovid.model;

import com.google.gson.annotations.SerializedName;

public class VaksinModel {
    @SerializedName("nama_lengkap")
    private final String namaLengkap;

    @SerializedName("nik")
    private final String nik;

    @SerializedName("phone")
    private final String phone;

    @SerializedName("created_at")
    private final String tanggal;

    public VaksinModel(String namaLengkap, String nik, String phone, String tanggal) {
        this.namaLengkap = namaLengkap;
        this.nik = nik;
        this.phone = phone;
        this.tanggal = tanggal;
    }

    public String getNamaLengkap() {
        return namaLengkap;
    }

    public String getNik() {
        return nik;
    }

    public String getPhone() {
        return phone;
    }

    public String getTanggal() {
        return tanggal;
    }
}
