package com.example.agnaldoburgojunior.myclassv1.Controllers;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseManager;
import com.example.agnaldoburgojunior.myclassv1.Models.Disciplina;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 21/03/2016.
 */
public class DisciplinaDAO {

    public static final String TABLE_DISCIPLINA = "disciplina";

    private static final String KEY_DISC_COD = "coddisciplina";
    private static final String DISC_COD_CURSO = "codcurso";
    private static final String DISC_NOME  = "nome";
    private static final String DISC_QUANT_AULA  = "qtaula";
    private static final String DISC_QUANT_HORAS  = "qthorasdisc";
    private static final String DISC_SEMESTRE  = "semestre";
    private static final String DISC_PROFESSOR  = "professor";
    private static final String DISC_EMAIL_PROF  = "email_prof";
    private static final String DISC_CONTEUDO_DISC  = "conteudo";

    public static String createTableDisciplina(){
        return "CREATE TABLE " + TABLE_DISCIPLINA + " ("
                + KEY_DISC_COD + " INTEGER PRIMARY KEY AUTOINCREMENT, "
                + DISC_COD_CURSO + " INTEGER, "
                + DISC_NOME + " VARCHAR(80), "
                + DISC_QUANT_AULA + " INTEGER, "
                + DISC_QUANT_HORAS + " INTEGER, "
                + DISC_SEMESTRE + " INTEGER, "
                + DISC_PROFESSOR + " VARCHAR(150), "
                + DISC_EMAIL_PROF + " VARCRAR(150), "
                + DISC_CONTEUDO_DISC + " TEXT )";
    }

    //***************************
    //******     CRUD     *******
    //***************************

    /**
     * CRUD
     * Created by Andressa on 26/03/2016.
     */

    public boolean insertDisciplina(Disciplina disciplina) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(DISC_COD_CURSO, disciplina.getCodcurso());
        cv.put(DISC_NOME, disciplina.getNome());
        cv.put(DISC_QUANT_AULA, disciplina.getQtaula());
        cv.put(DISC_QUANT_HORAS, disciplina.getQthorasdisc());
        cv.put(DISC_SEMESTRE, disciplina.getSemestre());
        cv.put(DISC_PROFESSOR, disciplina.getProfessor());
        cv.put(DISC_EMAIL_PROF, disciplina.getEmailProf());
        cv.put(DISC_CONTEUDO_DISC, disciplina.getConteudo());


        long result = db.insert(DisciplinaDAO.TABLE_DISCIPLINA, null, cv);

        if (result == -1)
            return false;

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public boolean updateDisciplina (Disciplina disciplina) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(KEY_DISC_COD, disciplina.getCoddisciplina());
        cv.put(DISC_COD_CURSO, disciplina.getCodcurso());
        cv.put(DISC_NOME, disciplina.getNome());
        cv.put(DISC_QUANT_AULA, disciplina.getQtaula());
        cv.put(DISC_QUANT_HORAS, disciplina.getQthorasdisc());
        cv.put(DISC_SEMESTRE, disciplina.getSemestre());
        cv.put(DISC_PROFESSOR, disciplina.getProfessor());
        cv.put(DISC_EMAIL_PROF, disciplina.getEmailProf());
        cv.put(DISC_CONTEUDO_DISC, disciplina.getConteudo());

        db.update(TABLE_DISCIPLINA, cv, KEY_DISC_COD + " = ?", new String[]{String.valueOf(disciplina.getCoddisciplina())});

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public List<Disciplina> selectTodosDisciplina() {

        List<Disciplina> listaDisciplina = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sql = "SELECT * FROM " + TABLE_DISCIPLINA;
        Cursor c = db.rawQuery(sql, null);

        if (c.moveToFirst()) {

            do {


                Disciplina t = new Disciplina();
                ContentValues cv = new ContentValues();

                t.setCoddisciplina(c.getInt(0));
                t.setCodcurso(c.getInt(1));
                t.setNome(c.getString(2));
                t.setQtaula(c.getInt(3));
                t.setQthorasdisc(c.getInt(4));
                t.setSemestre(c.getInt(5));
                t.setProfessor(c.getString(6));
                t.setEmailProf(c.getString(7));
                t.setConteudo(c.getString(8));

                listaDisciplina.add(t);

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return listaDisciplina;
    }

    public Disciplina selectDiscplina(int codigo) {
        Disciplina t = new Disciplina();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT * FROM " + TABLE_DISCIPLINA + " WHERE " + KEY_DISC_COD + " = ? ";
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{String.valueOf(codigo)});

        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                t.setCoddisciplina(c.getInt(0));
                t.setCodcurso(c.getInt(1));
                t.setNome(c.getString(2));
                t.setQtaula(c.getInt(3));
                t.setQthorasdisc(c.getInt(4));
                t.setSemestre(c.getInt(5));
                t.setProfessor(c.getString(6));
                t.setEmailProf(c.getString(7));
                t.setConteudo(c.getString(8));

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return t;
    }

    public int deleteDisciplina (String codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        int i = db.delete(TABLE_DISCIPLINA, KEY_DISC_COD + " = ? ", new String[]{codigo});

        DiaDisciplinaDAO dDAO = new DiaDisciplinaDAO();
        FaltaDAO fDAO = new FaltaDAO();
        fDAO.deleteTodasFaltaDisc(codigo);
        dDAO.deleteDiaDisciplina(codigo);

        DatabaseManager.getInstance().closeDatabase();
        return i;
    }

    public boolean selectDependenciasCurso(int codigo) {

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT * FROM " + TABLE_DISCIPLINA + " WHERE " + DISC_COD_CURSO + " = ? ";
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{String.valueOf(codigo)});

        int d = c.getCount();

        DatabaseManager.getInstance().closeDatabase();

        if(d >= 1)
            return true;
        else
            return false;
    }

    public int verificarCodSisciplina( String nome) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();
        Disciplina t = new Disciplina();
        String sql = " SELECT * FROM " + TABLE_DISCIPLINA + " WHERE " + DISC_NOME + " = ? ";
        Cursor c = db.rawQuery(sql, new String[]{nome});

        int i = 0;
        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                t.setCoddisciplina(c.getInt(0));
                t.setCodcurso(c.getInt(1));
                t.setNome(c.getString(2));
                t.setQtaula(c.getInt(3));
                t.setQthorasdisc(c.getInt(4));
                t.setSemestre(c.getInt(5));
                t.setProfessor(c.getString(6));
                t.setEmailProf(c.getString(7));
                t.setConteudo(c.getString(8));
                i = t.getCoddisciplina();
            } while (c.moveToNext());
        }
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }

    public String verificarNomeDisciplina(int cod) {
        Disciplina t = new Disciplina();
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sql = " SELECT * FROM " + TABLE_DISCIPLINA + " WHERE " + KEY_DISC_COD + " = ? ";
        Cursor c = db.rawQuery(sql, new String[]{String.valueOf(cod)});

        String result = null;
        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                t.setCoddisciplina(c.getInt(0));
                t.setCodcurso(c.getInt(1));
                t.setNome(c.getString(2));
                t.setQtaula(c.getInt(3));
                t.setQthorasdisc(c.getInt(4));
                t.setSemestre(c.getInt(5));
                t.setProfessor(c.getString(6));
                t.setEmailProf(c.getString(7));
                t.setConteudo(c.getString(8));
            } while (c.moveToNext());
        }

        result = t.getNome();
        DatabaseManager.getInstance().closeDatabase();

        return result;
    }


    public int pegarUltimoRegistro(){
        Disciplina t = new Disciplina();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        Cursor c = db.query(TABLE_DISCIPLINA, new String[]{KEY_DISC_COD},null,null,null,null,null);

        int result = 0;
        if (c.moveToLast()) {
            result = c.getInt(0);
        }
        c.close();
        DatabaseManager.getInstance().closeDatabase();
        return result;
    }
}
