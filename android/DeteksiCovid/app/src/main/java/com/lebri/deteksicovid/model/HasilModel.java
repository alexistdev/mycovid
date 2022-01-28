package com.lebri.deteksicovid.model;

import com.google.gson.annotations.SerializedName;

public class HasilModel {
    @SerializedName("kode_case")
    private final String kodeCase;

    @SerializedName("nama_case")
    private final String namaCase;

    @SerializedName("hasil_perhitungan")
    private final String hasilPerhitungan;

    public HasilModel(String kodeCase, String namaCase, String hasilPerhitungan) {
        this.kodeCase = kodeCase;
        this.namaCase = namaCase;
        this.hasilPerhitungan = hasilPerhitungan;
    }

    public String getKodeCase() {
        return kodeCase;
    }

    public String getNamaCase() {
        return namaCase;
    }

    public String getHasilPerhitungan() {
        return hasilPerhitungan;
    }
}
