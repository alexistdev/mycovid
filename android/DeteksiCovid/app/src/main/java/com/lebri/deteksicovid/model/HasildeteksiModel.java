package com.lebri.deteksicovid.model;

import com.google.gson.annotations.SerializedName;

public class HasildeteksiModel {
    @SerializedName("status")
    private final Boolean status;

    @SerializedName("message")
    private final String message;

    @SerializedName("penyakit")
    private final String penyakit;

    @SerializedName("perhitungan")
    private final String perhitungan;

    public HasildeteksiModel(Boolean status, String message, String penyakit, String perhitungan) {
        this.status = status;
        this.message = message;
        this.penyakit = penyakit;
        this.perhitungan = perhitungan;
    }

    public Boolean getStatus() {
        return status;
    }

    public String getMessage() {
        return message;
    }

    public String getPenyakit() {
        return penyakit;
    }

    public String getPerhitungan() {
        return perhitungan;
    }
}
