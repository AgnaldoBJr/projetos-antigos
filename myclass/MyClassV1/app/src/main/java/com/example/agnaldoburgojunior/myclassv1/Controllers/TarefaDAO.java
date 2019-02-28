package com.example.agnaldoburgojunior.myclassv1.Controllers;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.example.agnaldoburgojunior.myclassv1.Database.DatabaseManager;
import com.example.agnaldoburgojunior.myclassv1.Models.Tarefa;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 21/03/2016.
 */
public class TarefaDAO {

    public static final String TABLE_TAREFA = "tarefa";

    private static final String KEY_TAREFA_COD = "codtarefa";
    private static final String TAREFA_TIPO = "codtipo";
    private static final String TAREFA_DISC = "coddisciplina";
    private static final String TAREFA_NOME = "nome";
    private static final String TAREFA_ASSUNTO = "assunto";
    private static final String TAREFA_DATA = "data";
    private static final String TAREFA_PESO = "pesomedia";
    private static final String TAREFA_DESCRICAO = "descricao";
    private static final String TAREFA_NOTA = "nota";
    private static final String TAREFA_STATUS = "status";

    public static String createTableTarefa(){
        return "CREATE TABLE " + TABLE_TAREFA + " ("
                + KEY_TAREFA_COD + "  INTEGER PRIMARY KEY AUTOINCREMENT, "
                + TAREFA_TIPO + "  INTEGER, "
                + TAREFA_DISC + "  INTEGER, "
                + TAREFA_NOME + " VARCHAR(80), "
                + TAREFA_ASSUNTO + " VARCHAR(50), "
                + TAREFA_DATA + " TEXT , "
                + TAREFA_PESO + " FLOAT, "
                + TAREFA_DESCRICAO + " TEXT , "
                + TAREFA_NOTA + " FLOAT, "
                + TAREFA_STATUS + " INTEGER ) " ;
    }

    //***************************
    //******     CRUD     *******
    //***************************

    /**
     * CRUD
     * Created by Andressa on 26/03/2016.
     */

    public boolean insertTarefa(Tarefa tarefa) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(KEY_TAREFA_COD, tarefa.getCodtarefa());
        cv.put(TAREFA_TIPO, tarefa.getCodtipotarefa());
        cv.put(TAREFA_DISC, tarefa.getCoddisciplina());
        cv.put(TAREFA_NOME, tarefa.getNome());
        cv.put(TAREFA_ASSUNTO, tarefa.getAssunto());
        cv.put(TAREFA_DATA, tarefa.getData());
        cv.put(TAREFA_PESO, tarefa.getPeso());
        cv.put(TAREFA_DESCRICAO, tarefa.getDescricao());
        cv.put(TAREFA_NOTA, tarefa.getNota());
        cv.put(TAREFA_STATUS, tarefa.getStatus());

        long result = db.insert(TarefaDAO.TABLE_TAREFA, null, cv);

        if (result == -1)
            return false;

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public boolean updateTarefa (Tarefa tarefa) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        ContentValues cv = new ContentValues();
        cv.put(KEY_TAREFA_COD, tarefa.getCodtarefa());
        cv.put(TAREFA_TIPO, tarefa.getCodtipotarefa());
        cv.put(TAREFA_DISC, tarefa.getCoddisciplina());
        cv.put(TAREFA_NOME, tarefa.getNome());
        cv.put(TAREFA_ASSUNTO, tarefa.getAssunto());
        cv.put(TAREFA_DATA, tarefa.getData());
        cv.put(TAREFA_PESO, tarefa.getPeso());
        cv.put(TAREFA_DESCRICAO, tarefa.getDescricao());
        cv.put(TAREFA_NOTA, tarefa.getNota());
        cv.put(TAREFA_STATUS, tarefa.getStatus());
        db.update(TABLE_TAREFA, cv, KEY_TAREFA_COD + " = ?", new String[]{String.valueOf(tarefa.getCodtarefa())});

        DatabaseManager.getInstance().closeDatabase();
        return true;
    }

    public List<Tarefa> selectTodosTarefa() {

        List<Tarefa> listaTarefa = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = "SELECT * FROM " + TABLE_TAREFA;
        Cursor c = db.rawQuery(sqlTodosClientes, null);

        if (c.moveToFirst()) {

            do {
                Tarefa t = new Tarefa();
                t.setCodtarefa(c.getInt(0));//verificar os () com zero e um, copiei e colei entao nao sei se e zero ou um kkk
                t.setCodtipotarefa(c.getInt(1));
                t.setCoddisciplina(c.getInt(2));
                t.setNome(c.getString(3));
                t.setAssunto(c.getString(4));
                t.setData(c.getString(5));
                t.setPeso(c.getFloat(6));
                t.setDescricao(c.getString(7));
                t.setNota(c.getFloat(8));
                t.setStatus(c.getInt(9));
                listaTarefa.add(t);

            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return listaTarefa;
    }

    public int deleteTarefa (String codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        int i = db.delete(TABLE_TAREFA, KEY_TAREFA_COD + " = ? ", new String[]{codigo});
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }

    public int deleteTarefaDisci () {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        int i = db.delete(TABLE_TAREFA, TAREFA_DISC + " = 0 ", null);
        DatabaseManager.getInstance().closeDatabase();
        return i;
    }

    public boolean selectDependenciasDisciplinas(int codigo) {

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT * FROM " + TABLE_TAREFA + " WHERE " + TAREFA_DISC + " = ? ";
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{String.valueOf(codigo)});

        int d = c.getCount();
        System.out.println(d);

        DatabaseManager.getInstance().closeDatabase();

        if(d >= 1)
            return true;
        else
            return false;
    }

    public Tarefa selectTarefa(int codigo) {
        Tarefa t = new Tarefa();
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTar = "SELECT * FROM " + TABLE_TAREFA + " WHERE " + KEY_TAREFA_COD + " = ? ";
        Cursor c = db.rawQuery(sqlGetTar, new String[]{String.valueOf(codigo)});

        if (c.moveToFirst()) {

            do {
                ContentValues cv = new ContentValues();
                t.setCodtarefa(c.getInt(0));//verificar os () com zero e um, copiei e colei entao nao sei se e zero ou um kkk
                t.setCodtipotarefa(c.getInt(1));
                t.setCoddisciplina(c.getInt(2));
                t.setNome(c.getString(3));
                t.setAssunto(c.getString(4));
                t.setData(c.getString(5));
                t.setPeso(c.getFloat(6));
                t.setDescricao(c.getString(7));
                t.setNota(c.getFloat(8));
                t.setStatus(c.getInt(9));
            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return t;
    }
    //Metodo usado para verificar a existencia de registros cadastrados com algum Tipo de tarefa
    // Este metodo sera utilizado na Classe TipoTarefaView para dar autorização de acordo com o retorno desta na deleção de tipo de tarefa
    public boolean selectDependenciasTipoTarefa(int codigo) {

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlGetTipoRef = "SELECT * FROM " + TABLE_TAREFA + " WHERE " + TAREFA_TIPO + " = ? ";
        Cursor c = db.rawQuery(sqlGetTipoRef, new String[]{String.valueOf(codigo)});

        int d = c.getCount();
        System.out.println(d);

        DatabaseManager.getInstance().closeDatabase();

        if(d >= 1)
            return true;
        else
            return false;
    }


    public List<Tarefa> selectProximasTarefas(String hj,String dt) {

        List<Tarefa> listaTarefa = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = "SELECT "+KEY_TAREFA_COD+", "+TAREFA_TIPO+", "+TAREFA_DISC+", "+TAREFA_NOME+", "+TAREFA_ASSUNTO+", "+TAREFA_DATA
               +", " +TAREFA_PESO+", "+TAREFA_DESCRICAO+", "+TAREFA_NOTA+", "+TAREFA_STATUS
                +", replace("+TAREFA_DATA+",'-','') as dtint  FROM " + TABLE_TAREFA + " WHERE  dtint >= '"+hj+"' AND dtint <='"+dt+"'";

        Cursor c = db.rawQuery(sqlTodosClientes,null);
        System.out.println(sqlTodosClientes);
        if (c.moveToFirst()) {

            do {
                Tarefa t = new Tarefa();
                t.setCodtarefa(c.getInt(0));
                t.setCodtipotarefa(c.getInt(1));
                t.setCoddisciplina(c.getInt(2));
                t.setNome(c.getString(3));
                t.setAssunto(c.getString(4));
                t.setData(c.getString(5));
                t.setPeso(c.getFloat(6));
                t.setDescricao(c.getString(7));
                t.setNota(c.getFloat(8));
                t.setStatus(c.getInt(9));
                listaTarefa.add(t);

            } while (c.moveToNext());
        }

        for(int i = 0 ; i < listaTarefa.size() ; i++){
            System.out.println(listaTarefa.get(i).getNome());
        }

        DatabaseManager.getInstance().closeDatabase();
        return listaTarefa;
    }

    public void updateTarefaMetAval (int codigo) {
        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();


        ContentValues cv = new ContentValues();
        cv.put(TAREFA_DISC, codigo);

        db.update(TABLE_TAREFA, cv, TAREFA_DISC + " = ?", new String[]{String.valueOf(0)});


        DatabaseManager.getInstance().closeDatabase();

    }

    public List<Tarefa> selectTodosTarefaComPeso() {

        List<Tarefa> list = new ArrayList<>();

        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = "SELECT * FROM " + TABLE_TAREFA + " WHERE "+ TAREFA_PESO + " <=1 GROUP BY "+TAREFA_DISC;
        Cursor c = db.rawQuery(sqlTodosClientes,null);

        if (c.moveToFirst()) {

            do {
                Tarefa t = new Tarefa();
                t.setCodtarefa(c.getInt(0));//verificar os () com zero e um, copiei e colei entao nao sei se e zero ou um kkk
                t.setCodtipotarefa(c.getInt(1));
                t.setCoddisciplina(c.getInt(2));
                t.setNome(c.getString(3));
                t.setAssunto(c.getString(4));
                t.setData(c.getString(5));
                t.setPeso(c.getFloat(6));
                t.setDescricao(c.getString(7));
                t.setNota(c.getFloat(8));
                t.setStatus(c.getInt(9));

                list.add(t);
            } while (c.moveToNext());
        }

        DatabaseManager.getInstance().closeDatabase();
        return list;
    }


    public float selectMediaPorDisc(int codigo) {


        Tarefa t = new Tarefa();


        SQLiteDatabase db = DatabaseManager.getInstance().openDatabase();

        String sqlTodosClientes = "SELECT " +TAREFA_NOTA+", "+TAREFA_PESO+ " FROM " + TABLE_TAREFA + " WHERE "+ TAREFA_DISC + " =? ";
        Cursor c = db.rawQuery(sqlTodosClientes,new String[]{String.valueOf(codigo)});

        float media=0;
        if (c.moveToFirst()) {

            do {
                media+= c.getFloat(0) * c.getFloat(1);
            } while (c.moveToNext());
        }
        DatabaseManager.getInstance().closeDatabase();
        return media;
    }
}