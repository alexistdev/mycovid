package com.lebri.deteksicovid.API;

import android.content.Context;

import com.lebri.deteksicovid.BuildConfig;
import com.lebri.deteksicovid.config.Constants;
import com.lebri.deteksicovid.model.GetVaksin;
import com.lebri.deteksicovid.model.HasildeteksiModel;
import com.lebri.deteksicovid.model.PertanyaanModel;
import com.lebri.deteksicovid.model.UserModel;
import com.lebri.deteksicovid.model.VaksinModel;

import java.util.concurrent.TimeUnit;

import okhttp3.OkHttpClient;
import okhttp3.logging.HttpLoggingInterceptor;
import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.DELETE;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Headers;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface APIService {
	/* Otentikasi Login */
	@FormUrlEncoded
	@POST("api/login")
	Call<UserModel> cekLogin(@Field("email") String email,
							 @Field("password") String password);

    /* Fitur Ulangi */
    @DELETE("api/user/gejala")
    Call<HasildeteksiModel> hapusData(@Query("id_user") String idUser);


    /* Dapat pertanyaan Gejala */
    @GET("api/gejala")
    Call<PertanyaanModel> dataPertanyaan(@Query("id") String idUser);

    /* Dapat hasil deteksi */
    @GET("api/hasil")
    Call<HasildeteksiModel> datahasil(@Query("id_user") String idUser);

    /* Dapat pendaftaran vaksin */
    @GET("api/vaksin/list")
    Call<GetVaksin> dataVaksin(@Query("user_id") String idUser);

    /* Daftar Vaksin */
    @FormUrlEncoded
    @POST("api/vaksin")
    Call<VaksinModel> daftarVaksin(@Field("user_id") String idUser,
                                    @Field("nama_lengkap") String namaLengkap,
                                    @Field("nik") String nik,
                                   @Field("phone") String phone);

    /* menyimpan jawaban Gejala */
    @FormUrlEncoded
    @POST("api/gejala")
    Call<PertanyaanModel> simpanJawaban(@Field("id_user") String idUser,
                                           @Field("gejala_id") int idGejala,
                                           @Field("cf") String cfUser);

	class Factory{
		public static APIService create(Context mContext){
			OkHttpClient.Builder builder = new OkHttpClient.Builder();
			builder.readTimeout(20, TimeUnit.SECONDS);
			builder.connectTimeout(20, TimeUnit.SECONDS);
			builder.writeTimeout(20, TimeUnit.SECONDS);
			builder.addInterceptor(new NetworkConnectionInterceptor(mContext));
			HttpLoggingInterceptor logging = new HttpLoggingInterceptor();
			if(BuildConfig.DEBUG){
				logging.setLevel(HttpLoggingInterceptor.Level.BODY);
			}else {
				logging.setLevel(HttpLoggingInterceptor.Level.NONE);
			}

			//OkHttpClient client = builder.build();
			OkHttpClient client = builder.addInterceptor(logging).build();

			Retrofit retrofit = new Retrofit.Builder()
					.baseUrl(Constants.URL)
					.client(client)
					.addConverterFactory(GsonConverterFactory.create())
					.build();

			return retrofit.create(APIService.class);
		}
	}
}
