package com.example.agnaldoburgojunior.myclassv1.Controllers;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseManager;
import com.example.agnaldoburgojunior.myclassv1.Models.Curso;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 21/03/2016.
 */
public class CursoDAO {


    public static final String TABLE_CURSO = "curso";

    private static final String KEY_CURSO_COD = "codcurso";
    private static final String CURSO_ALUNO_RA = "ra";
    private static final String CURSO_NOME = "cursonome";
    private static final String CURSO_TURNO = "turno";
    private static final String CURSO_SEMESTRE = "semestre";
    private static final String CURSO_APROV = "porcaprovacao";
    private static final String CURSO_MEDIA = "media";
    private static final String CURSO_INSTITUICAO = "instituicao";

    public static String createTableCurso(){
        return "CREATE TABLE " + TABLE_CURSO + " ("
                + KEY_CURSO_COD + " INTEGER PRIMARY KEY AUTOINCREMENT, "
                + CURSO_ALUNO_RA + " INTEGER, "
                + CURSO_NOME + " VARCHAR(50), "
                + CURSO_TURNO + " VARCHAR(20), "
                + CURSO_SEMESTRE + " INTEGER, "
                + CURSO_APROV + " INTEGER, "
                + CURSO_MEDIA + " INTEGER, "
                + CURSO_INSTITUICAO + " VARCHAR(50))";
    }

    //***************************
    //******     CRUD     *******
    //***************************

    /**
     * CRUD
     * Created by Andressa on 26/03/2016.
     */

    public boolean insertCurso(Curso curso) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(CURSO_ALUNO_RA, curso.getRa());
        cv.put(CURSO_NOME, curso.getCursonome());
        cv.put(CURSO_TURNO, curso.getTurno());
        cv.put(CURSO_SEMESTRE, curso.getSemestre());
        cv.put(CURSO_APROV, curso.getPorcaprovacao());
        cv.put(CURSO_MEDIA, curso.getMediaaprov());
        cv.put(CURSO_INSTITUICAO, curso.getInstituicao());

        long result = db.insert(CursoDAO.TABLE_CURSO, null, cv);

        if (result == -1)
            return false;

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public boolean updateCurso (Curso curso) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(CURSO_ALUNO_RA, curso.getRa());
        cv.put(CURSO_NOME, curso.getCursonome());
        cv.put(CURSO_TURNO, curso.getTurno());
        cv.put(CURSO_SEMESTRE, curso.getSemestre());
        cv.put(CURSO_APROV, curso.getPorcaprovacao());
        cv.put(CURSO_MEDIA, curso.getMediaaprov());
        cv.put(CURSO_INSTITUICAO, curso.getInstituicao());

        db.update(TABLE_CURSO, cv, KEY_CURSO_COD + " = ? " , new String[]{String.valueOf(curso.getCodcurso())});

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public List<Curso> selectTodosCurso() {

        List<Curso> listaCurso = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = "SELECT * FROM " + TABLE_CURSO;
        Cursor c = db.rawQuery(sqlTodosClientes, null);

        if (c.moveToFirst()) {

            do {


                Curso t = new Curso();
                ContentValues cv = new ContentValues();

                t.setCodcurso(c.getInt(0));
                t.setRa(c.getInt(1));
                t.setCursonome(c.getString(2));
                t.setTurno(c.getString(3));
                t.setSemestre(c.getInt(4));
                t.setPorcaprovacao(c.getInt(5));
                t.setMediaaprov(c.getInt(6));
                t.setInstituicao(c.getString(7));

                listaCurso.add(t);

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return listaCurso;
    }

    public Curso selectCurso(int codigo) {
        Curso t = new Curso();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT * FROM " + TABLE_CURSO + " WHERE " + KEY_CURSO_COD + " = ? ";
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{String.valueOf(codigo)});

        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();

                t.setCodcurso(c.getInt(0));
                t.setRa(c.getInt(1));
                t.setCursonome(c.getString(2));
                t.setTurno(c.getString(3));
                t.setSemestre(c.getInt(4));
                t.setPorcaprovacao(c.getInt(5));
                t.setMediaaprov(c.getInt(6));
                t.setInstituicao(c.getString(7));

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return t;
    }

    public int deleteCurso (String codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        int i = db.delete(TABLE_CURSO, KEY_CURSO_COD + " = ? ", new String[]{codigo});
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }


    public int verificarCodCurso( String nome) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();
        Curso t = new Curso();
        String sql = " SELECT * FROM " + TABLE_CURSO + " WHERE " + CURSO_NOME + " = ? ";
        Cursor c = db.rawQuery(sql, new String[]{nome});

        int i = 0;
        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();

                t.setCodcurso(c.getInt(0));
                t.setRa(c.getInt(1));
                t.setCursonome(c.getString(2));
                t.setTurno(c.getString(3));
                t.setSemestre(c.getInt(4));
                t.setPorcaprovacao(c.getInt(5));
                t.setMediaaprov(c.getInt(6));
                t.setInstituicao(c.getString(7));
                i = t.getCodcurso();
            } while (c.moveToNext());
        }


        DatabaseManager.getInstance().closeDatabase();
        return i;
    }

    public String verificarNomeCurso(int cod) {
        Curso t = new Curso();
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = " SELECT * FROM " + TABLE_CURSO + " WHERE " + KEY_CURSO_COD + " = ? ";
        Cursor c = db.rawQuery(sqlTodosClientes, new String[]{String.valueOf(cod)});

        String result = null;
        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                t.setCodcurso(c.getInt(0));
                t.setRa(c.getInt(1));
                t.setCursonome(c.getString(2));
                t.setTurno(c.getString(3));
                t.setSemestre(c.getInt(4));
                t.setPorcaprovacao(c.getInt(5));
                t.setMediaaprov(c.getInt(6));
                t.setInstituicao(c.getString(7));

            } while (c.moveToNext());
        }
        result = t.getCursonome();
        DatabaseManager.getInstance().closeDatabase();
        System.out.println("BUSCAR NOME CURSO "+ result);
        return result;
    }
}
