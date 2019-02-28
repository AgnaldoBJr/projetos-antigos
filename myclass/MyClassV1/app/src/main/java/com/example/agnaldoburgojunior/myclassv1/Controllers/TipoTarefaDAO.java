package com.example.agnaldoburgojunior.myclassv1.Controllers;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseManager;
import com.example.agnaldoburgojunior.myclassv1.Models.TipoDeTarefa;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 21/03/2016.
 */
public class TipoTarefaDAO {

    public static final String TABLE_TIPO_TAREFA = "tipotarefa";

    private static final String KEY_TIPO_TAR = "codtipotarefa";
    private static final String TIPO_NOME = "tiponome";

    public static String createTableTipoTarefa() {
        return "CREATE TABLE " + TABLE_TIPO_TAREFA + " ("
                + KEY_TIPO_TAR + " INTEGER PRIMARY KEY AUTOINCREMENT, "
                + TIPO_NOME + " VARCHAR(20))";
    }

    //***************************
    //******     CRUD     *******
    //***************************

    /**
     * CRUD
     * Created by Andressa on 26/03/2016.
     */

    public boolean insertTipoTarefa(TipoDeTarefa tipoDeTarefa) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(TIPO_NOME, tipoDeTarefa.getTiponome());

        long result = db.insert(TipoTarefaDAO.TABLE_TIPO_TAREFA, null, cv);

        if (result == -1)
            return false;

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public boolean updateTipoTarefa (TipoDeTarefa tipoDeTarefa) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(KEY_TIPO_TAR, tipoDeTarefa.getCodtipodetarefa());
        cv.put(TIPO_NOME, tipoDeTarefa.getTiponome());

        db.update(TABLE_TIPO_TAREFA, cv, KEY_TIPO_TAR + " = ?", new String[]{String.valueOf(tipoDeTarefa.getCodtipodetarefa())});

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public List<TipoDeTarefa> selectTodosTipoTarefa() {

        List<TipoDeTarefa> listaTipoDeTarefa = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = "SELECT * FROM " + TABLE_TIPO_TAREFA;
        Cursor c = db.rawQuery(sqlTodosClientes, null);

        if (c.moveToFirst()) {

            do {


                TipoDeTarefa t = new TipoDeTarefa();
                ContentValues cv = new ContentValues();

                t.setCodtipodetarefa(c.getInt(0));
                t.setTiponome(c.getString(1));

                listaTipoDeTarefa.add(t);

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return listaTipoDeTarefa;
    }

    public TipoDeTarefa selectTipoTarefa(int codigo) {
        TipoDeTarefa tipoDeTarefa = new TipoDeTarefa();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT * FROM " + TABLE_TIPO_TAREFA+ " WHERE " + KEY_TIPO_TAR+ " = ? ";
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{String.valueOf(codigo)});

        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                tipoDeTarefa.setCodtipodetarefa(c.getInt(0));
                tipoDeTarefa.setTiponome(c.getString(1));

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return tipoDeTarefa;
    }

    public int deleteTipoTarefa (String codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        int i = db.delete(TABLE_TIPO_TAREFA, KEY_TIPO_TAR + " = ? ", new String[]{codigo});
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }


    public int verificarCodTipoRef( String nome) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();
        TipoDeTarefa t = new TipoDeTarefa();
        String sql = " SELECT * FROM " + TABLE_TIPO_TAREFA + " WHERE " + TIPO_NOME + " = ? ";
        Cursor c = db.rawQuery(sql, new String[]{nome});

        int i = 0;
        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                t.setCodtipodetarefa(c.getInt(0));
                t.setTiponome(c.getString(1));
                i = t.getCodtipodetarefa();
            } while (c.moveToNext());
        }
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }

    public String verificarNomeTipoTar(int cod) {
        TipoDeTarefa t = new TipoDeTarefa();
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sql = " SELECT * FROM " + TABLE_TIPO_TAREFA + " WHERE " + KEY_TIPO_TAR + " = ? ";
        Cursor c = db.rawQuery(sql, new String[]{String.valueOf(cod)});

        String result = null;
        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                t.setCodtipodetarefa(c.getInt(0));
                t.setTiponome(c.getString(1));
            } while (c.moveToNext());
        }

        result = t.getTiponome();
        DatabaseManager.getInstance().closeDatabase();

        return result;
    }
}