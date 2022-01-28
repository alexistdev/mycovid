package com.lebri.deteksicovid.model;

import com.google.gson.annotations.SerializedName;

public class PertanyaanModel {
    @SerializedName("status")
    private final Boolean status;

    @SerializedName("message")
    private final String message;

    @SerializedName("gejala_id")
    private final int idGejala;

    @SerializedName("gejala_name")
    private  String namaGejala;

    @SerializedName("selesai")
    private final Boolean selesai;

    public PertanyaanModel(Boolean status, String message, int idGejala, String namaGejala, Boolean selesai) {
        this.status = status;
        this.message = message;
        this.idGejala = idGejala;
        this.namaGejala = namaGejala;
        this.selesai = selesai;
    }

    public Boolean getStatus() {
        return status;
    }

    public String getMessage() {
        return message;
    }

    public int getIdGejala() {
        return idGejala;
    }

    public void setNamaGejala(String namaGejala) {
        this.namaGejala = namaGejala;
    }

    public String getNamaGejala() {
        return namaGejala;
    }

    public Boolean getSelesai() {
        return selesai;
    }
}
