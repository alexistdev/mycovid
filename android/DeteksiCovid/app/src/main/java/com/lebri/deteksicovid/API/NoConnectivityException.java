package com.lebri.deteksicovid.API;

import java.io.IOException;

public class NoConnectivityException extends IOException {
	@Override
	public String getMessage() {
		return "Tidak ada koneksi internet";
	}
}
