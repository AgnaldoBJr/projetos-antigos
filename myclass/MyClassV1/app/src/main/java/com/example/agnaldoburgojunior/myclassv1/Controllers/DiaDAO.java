package com.example.agnaldoburgojunior.myclassv1.Controllers;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseManager;
import com.example.agnaldoburgojunior.myclassv1.Models.Dia;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 21/03/2016.
 */
public class DiaDAO {

    public static final String TABLE_DIA = "dia";

    private static final String KEY_COD = "coddia";
    private static final String DIA_DIA = "dia";

   public static String createTableDia(){
       return "CREATE TABLE " + TABLE_DIA + " ("
               + KEY_COD + " INTEGER PRIMARY KEY AUTOINCREMENT, "
               + DIA_DIA + " VARCHAR(20)) ";
   }

    //***************************
    //******     CRUD     *******
    //***************************

    /**
     * CRUD
     * Created by Andressa on 26/03/2016.
     */

    public boolean insertDia(Dia dia) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(DIA_DIA, dia.getDia());

        long result = db.insert(DiaDAO.TABLE_DIA, null, cv);

        if (result == -1)
            return false;

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public List<Dia> selectTodosDia() {

        List<Dia> listaDia = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = "SELECT * FROM " + TABLE_DIA;
        Cursor c = db.rawQuery(sqlTodosClientes, null);

        if (c.moveToFirst()) {

            do {


                Dia t = new Dia();
                ContentValues cv = new ContentValues();

                t.setCoddia(c.getInt(0));
                t.setDia(c.getString(1));

                listaDia.add(t);

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return listaDia;
    }

    /* Não precisa dos outros métodos

    public boolean updateDia (Dia dia) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(KEY_COD, dia.getCoddia());
        cv.put(DIA_DIA, dia.getDia());

        db.update(TABLE_DIA, cv, KEY_COD + " = ?", new String[]{String.valueOf(dia.getCoddia())});

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }


    public int deleteDia (String codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        int i = db.delete(TABLE_DIA, KEY_COD + " = ? ", new String[]{codigo});
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }
   */

}

