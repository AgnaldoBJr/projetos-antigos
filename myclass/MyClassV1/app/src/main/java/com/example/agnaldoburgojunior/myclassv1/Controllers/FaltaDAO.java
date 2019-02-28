package com.example.agnaldoburgojunior.myclassv1.Controllers;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseManager;
import com.example.agnaldoburgojunior.myclassv1.Models.Falta;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 21/03/2016.
 */
public class FaltaDAO {

    public static final String TABLE_FALTA = "falta";

    private static final String KEY_FALTA_COD = "codfalta";
    private static final String FALTA_DISC = "coddisciplipa";
    private static final String FALTA_QUANT = "qtfaltas";
    private static final String FALTA_MOTIVO = "motivo";
    private static final String FALTA_DATA = "data";

    public static String createTableFalta() {
        return "CREATE TABLE " + TABLE_FALTA + " ("
                + KEY_FALTA_COD + " INTEGER PRIMARY KEY AUTOINCREMENT, "
                + FALTA_DISC + " INTEGER, "
                + FALTA_QUANT + " INTEGER, "
                + FALTA_MOTIVO + " VARCHAR(80), "
                + FALTA_DATA + " DATE )";
    }

    //***************************
    //******     CRUD     *******
    //***************************

    /**
     * CRUD
     * Created by Andressa on 26/03/2016.
     */

    public boolean insertFalta(Falta falta) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(KEY_FALTA_COD,falta.getCodfalta());
        cv.put(FALTA_DISC, falta.getCoddisciplina());
        cv.put(FALTA_QUANT, falta.getQtfaltas());
        cv.put(FALTA_MOTIVO, falta.getMotivo());
        cv.put(FALTA_DATA, falta.getData());

        long result = db.insert(TABLE_FALTA, null, cv);

        if (result == -1)
            return false;

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public boolean updateFalta (Falta falta) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(KEY_FALTA_COD, falta.getCodfalta());
        cv.put(FALTA_DISC, falta.getCoddisciplina());
        cv.put(FALTA_QUANT, falta.getQtfaltas());
        cv.put(FALTA_MOTIVO, falta.getMotivo());
        cv.put(FALTA_DATA, falta.getData());

        db.update(TABLE_FALTA, cv, KEY_FALTA_COD + " = ?", new String[]{String.valueOf(falta.getCodfalta())});

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public List<Falta> selectTodosFalta() { //esse select todos nao sei se ta certo

        List<Falta> listaFalta = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = "SELECT * FROM " + TABLE_FALTA;
        Cursor c = db.rawQuery(sqlTodosClientes, null);

        if (c.moveToFirst()) {

            do {
                Falta t = new Falta();
                ContentValues cv = new ContentValues();

                t.setCodfalta(c.getInt(0));
                t.setCoddisciplina(c.getInt(1));
                t.setQtfaltas(c.getInt(2));
                t.setMotivo(c.getString(3));
                t.setData(c.getString(4));

                listaFalta.add(t);

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return listaFalta;
    }

    public Falta selectFalta(int codigo) {
        Falta t = new Falta();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT * FROM " + TABLE_FALTA + " WHERE " + KEY_FALTA_COD + " = ? ";
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{String.valueOf(codigo)});

        if (c.moveToFirst()) {

            do {

                ContentValues cv = new ContentValues();

                t.setCodfalta(c.getInt(0));
                t.setCoddisciplina(c.getInt(1));
                t.setQtfaltas(c.getInt(2));
                t.setMotivo(c.getString(3));
                t.setData(c.getString(4));


            } while (c.moveToNext());
        }


        DatabaseManager.getInstance().closeDatabase();
        return t;
    }

    public int deleteFalta (String codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        int i = db.delete(TABLE_FALTA, KEY_FALTA_COD + " = ? ", new String[]{codigo});
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }


    public int deleteTodasFaltaDisc (String codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        int i = db.delete(TABLE_FALTA, FALTA_DISC + " = ? ", new String[]{codigo});
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }

    public int selectQtdFalta(String codigo) {


        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT " +" SUM("+FALTA_QUANT+")"+" FROM " + TABLE_FALTA + " WHERE " + FALTA_DISC + " = ?  GROUP BY "+FALTA_DISC;
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{codigo});

        int total=0;

        if (c.moveToFirst()) {

            do {

                total+=c.getInt(0);
                System.out.println(total);

            } while (c.moveToNext());
        }


        DatabaseManager.getInstance().closeDatabase();
        return total;
    }
}
