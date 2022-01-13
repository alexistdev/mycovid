package com.lebri.deteksicovid.model;

import com.google.gson.annotations.SerializedName;

public class UserModel {
	@SerializedName("id_user")
	private final String idUser;
	@SerializedName("email")
	private final String email;

	public UserModel(String idUser, String email) {
		this.idUser = idUser;
		this.email = email;
	}

	public String getIdUser() {
		return idUser;
	}

	public String getEmail() {
		return email;
	}
}
