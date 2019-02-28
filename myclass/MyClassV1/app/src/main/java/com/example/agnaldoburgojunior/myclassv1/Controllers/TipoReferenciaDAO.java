package com.example.agnaldoburgojunior.myclassv1.Controllers;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseManager;
import com.example.agnaldoburgojunior.myclassv1.Models.TipoReferencia;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 21/03/2016.
 */
public class TipoReferenciaDAO {

    public static final String TABLE_TIPO_REF = "tiporeferancia";

    private static final String KEY_TIPO_REF_COD = "codtipo";
    private static final String TIPO_REFERENCIA = "nome";


    public static String createTableTipoReferencia() {
        return "CREATE TABLE " + TABLE_TIPO_REF + " ("
                + KEY_TIPO_REF_COD + " INTEGER PRIMARY KEY AUTOINCREMENT, "
                + TIPO_REFERENCIA + " TEXT) ";
    }

    //***************************
    //******     CRUD     *******
    //***************************

    public boolean insertTipoReferencia(TipoReferencia tipoReferencia) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(TIPO_REFERENCIA, tipoReferencia.getNome());

        long result = db.insert(TipoReferenciaDAO.TABLE_TIPO_REF, null, cv);

        if (result == -1)
            return false;

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public boolean updateTipoReferencia(TipoReferencia tipoReferencia) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(KEY_TIPO_REF_COD, tipoReferencia.getCodTipo());
        cv.put(TIPO_REFERENCIA, tipoReferencia.getNome());

        db.update(TABLE_TIPO_REF, cv, KEY_TIPO_REF_COD + " = ?", new String[]{String.valueOf(tipoReferencia.getCodTipo())});

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public List<TipoReferencia> selectTodosTipoReferencia() {

        List<TipoReferencia> listaTipoReferencia = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = "SELECT * FROM " + TABLE_TIPO_REF;
        Cursor c = db.rawQuery(sqlTodosClientes, null);

        if (c.moveToFirst()) {

            do {

                TipoReferencia t = new TipoReferencia();
                ContentValues cv = new ContentValues();
                t.setCodTipo(c.getInt(0));
                t.setNome(c.getString(1));


                listaTipoReferencia.add(t);

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return listaTipoReferencia;
    }


    public TipoReferencia selectTipoReferencia(int codigo) {
        TipoReferencia tipoReferencia = new TipoReferencia();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT * FROM " + TABLE_TIPO_REF + " WHERE " + KEY_TIPO_REF_COD + " = ? ";
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{String.valueOf(codigo)});

        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                tipoReferencia.setCodTipo(c.getInt(0));
                tipoReferencia.setNome(c.getString(1));

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return tipoReferencia;
    }


    public int deleteTipoReferencia(String codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        //A função delete() retorna um int
        int i = db.delete(TABLE_TIPO_REF, KEY_TIPO_REF_COD + " = ? ", new String[]{codigo});
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }

    public int verificarCodTipoRef( String nome) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();
        TipoReferencia t = new TipoReferencia();
        String sql = " SELECT * FROM " + TABLE_TIPO_REF + " WHERE " + TIPO_REFERENCIA + " = ? ";
        Cursor c = db.rawQuery(sql, new String[]{nome});

        int i = 0;
        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                t.setCodTipo(c.getInt(0));
                t.setNome(c.getString(1));
                i = t.getCodTipo();
            } while (c.moveToNext());
        }
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }

    public String verificarNomeTipoRef(int cod) {
        TipoReferencia t = new TipoReferencia();
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sql = " SELECT * FROM " + TABLE_TIPO_REF + " WHERE " + KEY_TIPO_REF_COD + " = ? ";
        Cursor c = db.rawQuery(sql, new String[]{String.valueOf(cod)});

        String result = null;
        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                t.setCodTipo(c.getInt(0));
                t.setNome(c.getString(1));
            } while (c.moveToNext());
        }

        result = t.getNome();
        DatabaseManager.getInstance().closeDatabase();

        return result;
    }

}