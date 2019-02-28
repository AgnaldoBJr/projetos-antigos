package com.example.agnaldoburgojunior.myclassv1.Controllers;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseManager;
import com.example.agnaldoburgojunior.myclassv1.Models.DiaDisciplina;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 21/03/2016.
 */
public class DiaDisciplinaDAO {

    public static final String TABLE_DIA_DISCIPLINA = "diadisciplina";

    private static final String DIA_COD = "coddia";
    private static final String DISC_COD = "coddisciplina";

    public static String createTableDiaDisciplina(){
        return "CREATE TABLE " + TABLE_DIA_DISCIPLINA + " ("
                + DIA_COD + " INTEGER, "
                + DISC_COD + " INTEGER, "
                + " PRIMARY KEY ( " + DIA_COD + " , " + DISC_COD + ")) ";

    }

    //***************************
    //******     CRUD     *******
    //***************************

    /**
     * CRUD
     * Created by Andressa on 26/03/2016.
     */

    public boolean insertDiaDisciplina(DiaDisciplina diaDisciplina) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(DIA_COD, diaDisciplina.getCoddia());
        cv.put(DISC_COD, diaDisciplina.getCoddisciplina());

        long result = db.insert(DiaDisciplinaDAO.TABLE_DIA_DISCIPLINA, null, cv);

        if (result == -1)
            return false;

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public boolean updateDiaDisciplina (DiaDisciplina diaDisciplina) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(DIA_COD, diaDisciplina.getCoddia());
        cv.put(DISC_COD, diaDisciplina.getCoddisciplina());

        db.update(TABLE_DIA_DISCIPLINA, cv, DIA_COD +" AND "+ DISC_COD + " = ? ", new String[]{String.valueOf(diaDisciplina.getCoddia()),
                String.valueOf(diaDisciplina.getCoddisciplina())});

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public List<DiaDisciplina> selectTodosDiaDisciplina() {

        List<DiaDisciplina> listaDiaDisciplina = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodos = "SELECT * FROM " + TABLE_DIA_DISCIPLINA;
        Cursor c = db.rawQuery(sqlTodos, null);

        if (c.moveToFirst()) {

            do {


                DiaDisciplina t = new DiaDisciplina();
                ContentValues cv = new ContentValues();

                t.setCoddia(c.getInt(0));
                t.setCoddisciplina(c.getInt(1));

                listaDiaDisciplina.add(t);

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return listaDiaDisciplina;
    }

    public List<DiaDisciplina> selectDiaDisciplina(int codigo) {

        List<DiaDisciplina> listaDiaDisciplina = new ArrayList<DiaDisciplina>();
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sql = "SELECT * FROM " + TABLE_DIA_DISCIPLINA + " WHERE " + DISC_COD + " = ? ";
        Cursor c = db.rawQuery(sql, new String[]{String.valueOf(codigo)});

       if(c.moveToFirst()){
            do {
                DiaDisciplina d = new DiaDisciplina();
                d.setCoddia(c.getInt(0));
                d.setCoddisciplina(c.getInt(1));
                listaDiaDisciplina.add(d);
            }while (c.moveToNext());
        }
        c.close();
        DatabaseManager.getInstance().closeDatabase();
        return listaDiaDisciplina;
    }

    public int deleteDiaDisciplina (String codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        int i = db.delete(TABLE_DIA_DISCIPLINA, DISC_COD + " = ?", new String[]{codigo});

        DatabaseManager.getInstance().closeDatabase();
        return i;
    }


    public boolean updateDependencias (String cod) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();
        DiaDisciplina diaDisciplina = new DiaDisciplina();

        ContentValues cv = new ContentValues();
        cv.put(DIA_COD, diaDisciplina.getCoddia());
        cv.put(DISC_COD, diaDisciplina.getCoddisciplina());

        db.update(TABLE_DIA_DISCIPLINA, cv, DISC_COD + " = ?", new String[]{cod});
        DatabaseManager.getInstance().closeDatabase();
        return true;
    }
}
