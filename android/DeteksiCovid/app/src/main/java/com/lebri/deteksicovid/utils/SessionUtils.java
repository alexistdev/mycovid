package com.lebri.deteksicovid.utils;

import android.content.Context;
import android.content.SharedPreferences;


import com.google.gson.Gson;
import com.lebri.deteksicovid.config.Constants;

public class SessionUtils {
    public static boolean login(Context context, String IdUser){
        SharedPreferences sharedPreferences = context.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        String userJson = new Gson().toJson(IdUser);
        editor.putString(Constants.USER_SESSION, userJson);
        editor.putString("idUser", IdUser);
        editor.apply();
        return true;
    }
    public static boolean isLoggedIn(Context context) {
        SharedPreferences sharedPreferences = context.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String userJson = sharedPreferences.getString(Constants.USER_SESSION, null);
        if (userJson != null) {
            return true;
        } else {
            return false;
        }
    }

    public static String getLoggedUser(Context context) {
        SharedPreferences sharedPreferences = context.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String userJson = sharedPreferences.getString("idUser", "");
        if (userJson != "") {
            return userJson;
        } else
            return null;
    }
    public static boolean logout(Context context) {
        SharedPreferences sharedPreferences = context.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.apply();

        return true;
    }


}
