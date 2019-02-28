package com.example.agnaldoburgojunior.myclassv1.Controllers;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseManager;
import com.example.agnaldoburgojunior.myclassv1.Models.Referencia;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 21/03/2016.
 */
public class ReferenciaDAO {

    public static final String TABLE_REFERENCIA = "referencia";


    private static final String KEY_REF_COD = "codreferencias";
    private static final String REF_TIPO = "codtipo";
    private static final String REF_TITULO = "titulo";
    private static final String REF_AUTOR = "autor";
    private static final String REF_EDICAO = "edicao";
    private static final String REF_ANO = "ano";
    private static final String REF_URL = "url";
    private static final String REF_DATA_AC = "data_acesso";
    private static final String REF_COMENTARIOS = "comentarios";

    public static String createTableReferencia(){
        return "CREATE TABLE " + TABLE_REFERENCIA + " ("
                + KEY_REF_COD + " INTEGER PRIMARY KEY AUTOINCREMENT, "
                + REF_TIPO + " INTEGER, "
                + REF_TITULO + " VARCHAR(150), "
                + REF_AUTOR + " VARCHAR(80), "
                + REF_EDICAO + " TEXT, "
                + REF_ANO + " TEXT, "
                + REF_URL + " TEXT, "
                + REF_DATA_AC + " DATE, "
                + REF_COMENTARIOS + " TEXT)";
    }
    //***************************
    //******     CRUD     *******
    //***************************

    /**
     * CRUD
     * Created by Andressa on 26/03/2016.
     */

    public boolean insertReferencia(Referencia referencia) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(REF_TIPO, referencia.getCodtipo());
        cv.put(REF_TITULO, referencia.getTitulo());
        cv.put(REF_AUTOR, referencia.getAutor());
        cv.put(REF_EDICAO, referencia.getEdicao());
        cv.put(REF_ANO, referencia.getAno());
        cv.put(REF_URL, referencia.getUrl());
        cv.put(REF_DATA_AC, String.valueOf(referencia.getDataacesso()));
        cv.put(REF_COMENTARIOS, referencia.getComentarios());


        long result = db.insert(ReferenciaDAO.TABLE_REFERENCIA, null, cv);

        if (result == -1)
            return false;

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public boolean updateReferencia (Referencia referencia) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(KEY_REF_COD,referencia.getCodreferncias());
        cv.put(REF_TIPO, referencia.getCodtipo());
        cv.put(REF_TITULO, referencia.getTitulo());
        cv.put(REF_AUTOR, referencia.getAutor());
        cv.put(REF_EDICAO, referencia.getEdicao());
        cv.put(REF_ANO, referencia.getAno());
        cv.put(REF_URL, referencia.getUrl());
        cv.put(REF_DATA_AC, String.valueOf(referencia.getDataacesso()));
        cv.put(REF_COMENTARIOS, referencia.getComentarios());

        db.update(TABLE_REFERENCIA, cv, KEY_REF_COD + " = ?", new String[]{String.valueOf(referencia.getCodreferncias())});

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public List<Referencia> selectTodosReferencia() {//esse select todos nao sei se ta certo

        List<Referencia> listaReferencia = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = "SELECT * FROM " + TABLE_REFERENCIA;
        Cursor c = db.rawQuery(sqlTodosClientes, null);

        if (c.moveToFirst()) {

            do {

                Referencia r = new Referencia();
                ContentValues cv = new ContentValues();

                r.setCodreferncias(c.getInt(0));
                r.setCodtipo(c.getInt(1));
                r.setTitulo(c.getString(2));
                r.setAutor(c.getString(3));
                r.setEdicao(c.getString(4));
                r.setAno(c.getString(5));
                r.setUrl(c.getString(6));
                r.setDataacesso(c.getString(7));
                r.setComentarios(c.getString(8));

                listaReferencia.add(r);

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return listaReferencia;
    }

    public Referencia selectReferencia(int codigo) {
       Referencia r = new Referencia();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT * FROM " + TABLE_REFERENCIA + " WHERE " + KEY_REF_COD + " = ? ";
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{String.valueOf(codigo)});

        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                r.setCodreferncias(c.getInt(0));
                r.setCodtipo(c.getInt(1));
                r.setTitulo(c.getString(2));
                r.setAutor(c.getString(3));
                r.setEdicao(c.getString(4));
                r.setAno(c.getString(5));
                r.setUrl(c.getString(6));
                r.setDataacesso(c.getString(7));
                r.setComentarios(c.getString(8));

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return r;
    }

    public int deleteReferencia (String codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        int i = db.delete(TABLE_REFERENCIA, KEY_REF_COD + " = ? ", new String[]{codigo});
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }


    public boolean selectDependencias(int codigo) {

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT * FROM " + TABLE_REFERENCIA + " WHERE " + REF_TIPO + " = ? ";
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{String.valueOf(codigo)});

        int d = c.getCount();
        System.out.println(d);

        DatabaseManager.getInstance().closeDatabase();

        if(d >=1)
            return true;
        else
            return false;
    }

}
