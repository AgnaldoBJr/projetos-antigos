package com.example.agnaldoburgojunior.myclassv1.App;

import android.app.Application;
import android.content.Context;

import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseHelper;
import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseManager;

/**
 * Created by Agnaldo.Burgo.Junior on 22/03/2016.
 */
public class App extends Application{
        private static Context context;
        private static DatabaseHelper dbHelper;

        @Override
        public void onCreate()
        {
            super.onCreate();
            context = this.getApplicationContext();
            dbHelper = new DatabaseHelper();
            DatabaseManager.initializeInstance(dbHelper);

        }

        public static Context getContext(){
            return context;
        }
}
