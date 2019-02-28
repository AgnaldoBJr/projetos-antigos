package com.example.agnaldoburgojunior.myclassv1.Database;

import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import com.example.agnaldoburgojunior.myclassv1.App.App;
import com.example.agnaldoburgojunior.myclassv1.Controllers.CursoDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.DiaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.DiaDisciplinaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.DisciplinaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.FaltaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.ReferenciaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoReferenciaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoTarefaDAO;

/**
 * Created by Agnaldo.Burgo.Junior on 01/03/2016.
 */
public class DatabaseHelper extends SQLiteOpenHelper{
    // Logcat tag
    private static final String LOG = "DatabaseHelper";

    // Versão
    private static final int VERSION_DB = 30;

    // Nome do banco de dados
    private static final String DATABASE_NAME = "myclassV1";


    public DatabaseHelper() {
        super(App.getContext(), DATABASE_NAME, null, VERSION_DB);

    }

    @Override
    public void onCreate(SQLiteDatabase db) {

        db.execSQL(CursoDAO.createTableCurso());
        db.execSQL(DisciplinaDAO.createTableDisciplina());
        db.execSQL(DiaDisciplinaDAO.createTableDiaDisciplina());
        db.execSQL(DiaDAO.createTableDia());
        db.execSQL(FaltaDAO.createTableFalta());
        db.execSQL(TarefaDAO.createTableTarefa());
        db.execSQL(TipoTarefaDAO.createTableTipoTarefa());
        db.execSQL(ReferenciaDAO.createTableReferencia());
        db.execSQL(TipoReferenciaDAO.createTableTipoReferencia());

        db.execSQL("INSERT INTO " + TipoTarefaDAO.TABLE_TIPO_TAREFA + " (tiponome) VALUES ('Prova');");
        db.execSQL("INSERT INTO " + TipoTarefaDAO.TABLE_TIPO_TAREFA + " (tiponome) VALUES ('Trabalho');");
        db.execSQL("INSERT INTO " + TipoTarefaDAO.TABLE_TIPO_TAREFA + " (tiponome) VALUES ('Projeto');");

        db.execSQL("INSERT INTO " + TipoReferenciaDAO.TABLE_TIPO_REF + " (nome) VALUES ('Livro');");
        db.execSQL("INSERT INTO " + TipoReferenciaDAO.TABLE_TIPO_REF + " (nome) VALUES ('Página Web');");
        db.execSQL("INSERT INTO " + TipoReferenciaDAO.TABLE_TIPO_REF + " (nome) VALUES ('Artigo');");

        }


    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + CursoDAO.TABLE_CURSO);
        db.execSQL("DROP TABLE IF EXISTS " + DisciplinaDAO.TABLE_DISCIPLINA);
        db.execSQL("DROP TABLE IF EXISTS " + DiaDisciplinaDAO.TABLE_DIA_DISCIPLINA);
        db.execSQL("DROP TABLE IF EXISTS " + DiaDAO.TABLE_DIA);
        db.execSQL("DROP TABLE IF EXISTS " + FaltaDAO.TABLE_FALTA);
        db.execSQL("DROP TABLE IF EXISTS " + TarefaDAO.TABLE_TAREFA);
        db.execSQL("DROP TABLE IF EXISTS " + TipoTarefaDAO.TABLE_TIPO_TAREFA);
        db.execSQL("DROP TABLE IF EXISTS " + ReferenciaDAO.TABLE_REFERENCIA);
        db.execSQL("DROP TABLE IF EXISTS " + TipoReferenciaDAO.TABLE_TIPO_REF);

        onCreate(db);
    }

}
