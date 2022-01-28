package com.lebri.deteksicovid.ui;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import com.lebri.deteksicovid.API.APIService;
import com.lebri.deteksicovid.MainActivity;
import com.lebri.deteksicovid.R;
import com.lebri.deteksicovid.helper.ErrorUtils;
import com.lebri.deteksicovid.helper.SessionHandle;
import com.lebri.deteksicovid.model.APIError;
import com.lebri.deteksicovid.model.UserModel;
import java.util.regex.Pattern;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Login extends AppCompatActivity {
	private EditText mEmail, mPassword;
	private Button mLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        init();
        //cek login
        if(SessionHandle.isLoggedIn(this)){
            Intent intent = new Intent(Login.this, MainActivity.class);
            startActivity(intent);
            finish();
        }
        mLogin.setOnClickListener(v -> {

			String email = mEmail.getText().toString();
			String password = mPassword.getText().toString();
			if(email.trim().length()> 0 && password.trim().length() >0){
				if(cekEmail(email)){
					checkLogin(email,password);
				}else{
					pesan("Masukkan email yang valid !");
				}
			} else {
				pesan("Semua kolom harus diisi!");
			}
		});

    }

	private void checkLogin(final String email, final String password){
		try {
			Call<UserModel> login = APIService.Factory.create(getApplicationContext()).cekLogin(email,password);
			login.enqueue(new Callback<UserModel>() {
				@EverythingIsNonNull
			    @Override
				public void onResponse(@NonNull Call<UserModel> call, Response<UserModel> response) {
					if(response.isSuccessful()) {
						if (response.body() != null) {
							if (SessionHandle.login(Login.this, response.body().getIdUser())){
								Intent intent = new Intent(Login.this, MainActivity.class);
								startActivity(intent);
								finish();
							}
						}
					} else {
						APIError error = ErrorUtils.parseError(response);
						pesan(error.message());
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<UserModel> call, Throwable t) {
					pesan(t.getMessage());
				}
			});
		} catch (Exception e){
			e.printStackTrace();
			pesan(e.getMessage());
		}
	}
	private boolean cekEmail(String email){
		return Pattern.compile("^(([\\w-]+\\.)+[\\w-]+|([a-zA-Z]{1}|[\\w-]{2,}))@"
				+ "((([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
				+ "[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\."
				+ "([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
				+ "[0-9]{1,2}|25[0-5]|2[0-4][0-9])){1}|"
				+ "([a-zA-Z]+[\\w-]+\\.)+[a-zA-Z]{2,4})$").matcher(email).matches();
	}

	public void init() {
		mEmail = findViewById(R.id.txt_email);
		mPassword = findViewById(R.id.txt_password);
		mLogin = findViewById(R.id.btn_login);
	}

	public void pesan(String msg)
	{
		Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
	}
}
