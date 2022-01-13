package com.lebri.deteksicovid;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.os.Bundle;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.lebri.deteksicovid.fragment.Akun_fragment;
import com.lebri.deteksicovid.fragment.bantuan_fragment;
import com.lebri.deteksicovid.fragment.home_fragment;
import com.lebri.deteksicovid.fragment.vaksin_fragment;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
		loadFragment(new home_fragment());
		/* Mengatur Menu bottom bar */
		BottomNavigationView bottomNavigationView = findViewById(R.id.bottomMenu);
		bottomNavigationView.setOnNavigationItemSelectedListener(item -> {
			Fragment fragment = null;
			switch (item.getItemId()){
				case R.id.home_menu:
					fragment = new home_fragment();
					break;
				case R.id.history_menu:
					fragment = new vaksin_fragment();
					break;
				case R.id.inbox_menu:
					fragment = new bantuan_fragment();
					break;
				default:
					fragment = new Akun_fragment();
			}
			return loadFragment(fragment);
		});
    }

	private boolean loadFragment(Fragment fragment) {
		if (fragment != null) {
			getSupportFragmentManager().beginTransaction()
					.replace(R.id.fl_container, fragment)
					.commit();
			return true;
		}
		return false;
	}
}
