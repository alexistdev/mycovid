package com.lebri.deteksicovid.model;

import com.google.gson.annotations.SerializedName;

import java.util.List;

public class GetVaksin {
    @SerializedName("status")
    private final Boolean status;
    @SerializedName("result")
    private final List<VaksinModel> daftarVaksin;
    @SerializedName("message")
    private final String message;

    public GetVaksin(Boolean status, List<VaksinModel> daftarVaksin, String message) {
        this.status = status;
        this.daftarVaksin = daftarVaksin;
        this.message = message;
    }

    public Boolean getStatus() {
        return status;
    }

    public List<VaksinModel> getDaftarVaksin() {
        return daftarVaksin;
    }

    public String getMessage() {
        return message;
    }
}
