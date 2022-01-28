package com.lebri.deteksicovid;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;

import com.lebri.deteksicovid.ui.Login;
import com.lebri.deteksicovid.utils.SessionUtils;

import java.util.Timer;
import java.util.TimerTask;

public class SplashActivity extends AppCompatActivity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_splash);

        if(SessionUtils.isLoggedIn(this)){
            Intent intent = new Intent(SplashActivity.this, MainActivity.class);
            startActivity(intent);
            finish();
        }

        int timeout = 3000;

        Timer timer = new Timer();
        timer.schedule(new TimerTask() {

            @Override
            public void run() {
                finish();
                Intent homepage = new Intent(SplashActivity.this, MainActivity.class);
                startActivity(homepage);
            }
        }, timeout);
    }
}
