package com.example.agnaldoburgojunior.myclassv1.Activitys;

import android.app.AlertDialog;
import android.app.FragmentManager;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.Spinner;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu.DialogMetodoAval;
import com.example.agnaldoburgojunior.myclassv1.Controllers.CursoDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.DiaDisciplinaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.DisciplinaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Models.Curso;
import com.example.agnaldoburgojunior.myclassv1.Models.DiaDisciplina;
import com.example.agnaldoburgojunior.myclassv1.Models.Disciplina;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.ArrayList;
import java.util.List;

public class DisciplinaView extends AppCompatActivity{

    Spinner curso;
    EditText nome;
    EditText qtAula;
    CheckBox seg;
    CheckBox ter;
    CheckBox qua;
    CheckBox qui;
    CheckBox sex;
    CheckBox sab;
    CheckBox dom;
    EditText carga;
    Spinner semestre;
    EditText prof;
    EditText email;
    EditText conteudo;
    com.github.clans.fab.FloatingActionButton inserir;
    List<Curso> listC;
    ArrayAdapter<Curso> arrayAdapter;
    ArrayAdapter<Integer> arrayAdapter2;
    boolean visible = false;
    int cod;

    ArrayList<Integer> semList = new ArrayList<>();

    //variaveis do metodo avaliativo
    private LinearLayout ll;
    private com.github.clans.fab.FloatingActionButton create;
    private int count = 0;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_disciplina_view);

        //Insere o botão de voltar na tela
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        curso = (Spinner) findViewById(R.id.curso_disc_spinner);
        nome = (EditText) findViewById(R.id.nome_disciplina);
        qtAula = (EditText) findViewById(R.id.qtaula_disciplina);
        seg = (CheckBox) findViewById(R.id.seg);
        ter = (CheckBox) findViewById(R.id.ter);
        qua = (CheckBox) findViewById(R.id.qua);
        qui = (CheckBox) findViewById(R.id.qui);
        sex = (CheckBox) findViewById(R.id.sex);
        sab = (CheckBox) findViewById(R.id.sab);
        dom = (CheckBox) findViewById(R.id.dom);
        carga = (EditText) findViewById(R.id.carga_disciplina);
        semestre = (Spinner) findViewById(R.id.semestre);
        prof = (EditText) findViewById(R.id.professor_disciplina);
        email = (EditText) findViewById(R.id.email_disciplina);
        conteudo = (EditText) findViewById(R.id.conteudo_disciplina);
        inserir = (com.github.clans.fab.FloatingActionButton) findViewById(R.id.inserir_disciplina);



        getSemestreValor();

        //Setar os valores para o Spinner Curso
        CursoDAO cDAO = new CursoDAO();
        listC = cDAO.selectTodosCurso();
        arrayAdapter  = new ArrayAdapter<Curso>(this, android.R.layout.simple_spinner_dropdown_item, listC );
        arrayAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        curso.setAdapter(arrayAdapter);


        //---------Tratamento de Validação caso não tenha Curso cadastrado----------
        // Caso haja Curso cadastrado é possivel realizar a inclusao de dados

        if(!arrayAdapter.isEmpty()) {

            inserir.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Disciplina disciplina = new Disciplina();

                    int qtd, car;

                    if (qtAula.getText().toString().isEmpty())
                        qtd = 0;
                    else
                        qtd = Integer.parseInt(qtAula.getText().toString());

                    if (carga.getText().toString().isEmpty())
                        car = 0;
                    else
                        car = Integer.parseInt(carga.getText().toString());

                    CursoDAO cDAO = new CursoDAO();
                    int codCurso = cDAO.verificarCodCurso(String.valueOf(curso.getSelectedItem()));

                    disciplina.setCodcurso(codCurso);
                    disciplina.setNome(nome.getText().toString());
                    disciplina.setQtaula(qtd);
                    disciplina.setQthorasdisc(car);
                    disciplina.setSemestre((Integer) semestre.getSelectedItem());
                    System.out.println(semestre.getSelectedItem());
                    disciplina.setProfessor(prof.getText().toString());
                    disciplina.setEmailProf(email.getText().toString());
                    disciplina.setConteudo(conteudo.getText().toString());

                    if ( !qtAula.getText().toString().equals("") && !carga.getText().toString().equals("") && !nome.getText().toString().equals("")) {
                        DisciplinaDAO disciplinaDAO = new DisciplinaDAO();
                        boolean isInserted = disciplinaDAO.insertDisciplina(disciplina);

                        if (isInserted == true) {
                            Toast.makeText(DisciplinaView.this, "Inserido com sucesso!", Toast.LENGTH_SHORT).show();
                            int cod = disciplinaDAO.pegarUltimoRegistro();
                            salvarDia(cod);

                            //Altera o código da disciplina das tarefas inseridas no metodo avaliativo - :D
                            TarefaDAO tDAO = new TarefaDAO();
                            tDAO.updateTarefaMetAval(cod);

                            finish();
                        } else {
                            Toast.makeText(DisciplinaView.this, "Não inserido!", Toast.LENGTH_SHORT).show();
                        }
                    } else {
                        Toast.makeText(DisciplinaView.this, "Insira os Campos Obrigatórios", Toast.LENGTH_SHORT).show();
                        if (qtAula.getText().toString().equals(""))
                            qtAula.setError("Campo Obrigatório");

                        if (carga.getText().toString().equals(""))
                            carga.setError("Campo Obrigatório");

                        if (nome.getText().toString().equals(""))
                            nome.setError("Campo Obrigatório");
                    }
                }
            });
        }
        //Caso não haja cursos cadastrados
        else{
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
            alertDialog.setTitle("Aviso");
            alertDialog.setCancelable(false);
            alertDialog.setMessage("Você não possui cursos cadastrados!\nDeseja cadastrar?");
            alertDialog.setNegativeButton("Cancelar", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    finish();
                }
            });
            alertDialog.setPositiveButton("Ir",
                    new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog,
                                            int whichButton) {
                            finish();
                            Intent i = new Intent(getApplicationContext(), CursoView.class);
                            Bundle b = new Bundle();
                            b.putInt("codcurso", 0);
                            i.putExtras(b);
                            startActivity(i);
                        }
                    }
            );
            alertDialog.show();
        }


        //Metodo Avaliativo---------------------------------------------------------
        create = (com.github.clans.fab.FloatingActionButton) findViewById(R.id.criar);
        create.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                FragmentManager fm = getFragmentManager();
                DialogMetodoAval dialogMetodoAval = new DialogMetodoAval();
                dialogMetodoAval.show(fm, "Dialog");

            }
        });
        //----------------------------------------------------------------------------
    }
    //metodo para realizar a insercao na tabela Dia Disciplina ( Utilizado na Inclusão e Alteracao de Disciplinas)
    private void salvarDia(int cod) {
        DiaDisciplinaDAO d = new DiaDisciplinaDAO();
        DiaDisciplina dia = new DiaDisciplina();

        if (seg.isChecked()) {
            int s = 1;
            dia.setCoddia(s);
            dia.setCoddisciplina(cod);
            d.insertDiaDisciplina(dia);
        }
        if (ter.isChecked()) {
            int t = 2;
            dia.setCoddia(t);
            dia.setCoddisciplina(cod);
            d.insertDiaDisciplina(dia);
        }
        if (qua.isChecked()) {
            int qa = 3;
            dia.setCoddia(qa);
            dia.setCoddisciplina(cod);
            d.insertDiaDisciplina(dia);
        }
        if (qui.isChecked()) {
            int qi = 4;
            dia.setCoddia(qi);
            dia.setCoddisciplina(cod);
            d.insertDiaDisciplina(dia);
        }
        if (sex.isChecked()) {
            int se = 5;
            dia.setCoddia(se);
            dia.setCoddisciplina(cod);
            d.insertDiaDisciplina(dia);
        }
        if (sab.isChecked()) {
            int sa = 6;
            dia.setCoddia(sa);
            dia.setCoddisciplina(cod);
            d.insertDiaDisciplina(dia);
        }
        if (dom.isChecked()) {
            int domin = 7;
            dia.setCoddia(domin);
            dia.setCoddisciplina(cod);
            d.insertDiaDisciplina(dia);
        }
    }


    @Override
    protected void onResume() {
        super.onResume();

        Bundle b = this.getIntent().getExtras();
        cod = b.getInt("cod");

        if (cod != 0) {
            Disciplina t = new Disciplina();
            DisciplinaDAO tDAO = new DisciplinaDAO();

            arrayAdapter.notifyDataSetChanged();
            t = tDAO.selectDiscplina(cod);
            CursoDAO cDAO = new CursoDAO();

            //Setar checagem dos dias da semana de acordo com o banco
            DiaDisciplinaDAO diaDAO = new DiaDisciplinaDAO();
            List<DiaDisciplina> d = diaDAO.selectDiaDisciplina(cod);
            int i = 0;
            while (i < d.size()) {
                if ((d.get(i).getCoddia()) == 1) {
                    seg.setChecked(true);
                }
                if ((d.get(i).getCoddia()) == 2) {
                    ter.setChecked(true);
                }
                if ((d.get(i).getCoddia()) == 3) {
                    qua.setChecked(true);
                }
                if ((d.get(i).getCoddia()) == 4) {
                    qui.setChecked(true);
                }
                if ((d.get(i).getCoddia()) == 5) {
                    sex.setChecked(true);
                }
                if ((d.get(i).getCoddia()) == 6) {
                    sab.setChecked(true);
                }
                if ((d.get(i).getCoddia()) == 7) {
                    dom.setChecked(true);
                }

                i++;
            }

            //seta visibilidade falsa para o botao inserir, para q seja possivel realizar a alteracao por meio do Menu Item
            inserir.setVisibility(View.INVISIBLE);

            semestre.setSelection(getIndex(semestre, String.valueOf(t.getSemestre())));

            curso.setSelection(getIndex(curso, String.valueOf(cDAO.verificarNomeCurso(t.getCodcurso()))));

            nome.setText(t.getNome());
            qtAula.setText(t.getQtaula().toString());
            carga.setText(t.getQthorasdisc().toString());

            prof.setText(t.getProfessor());
            email.setText(t.getEmailProf());
            conteudo.setText(t.getConteudo());

            //Até o momento não entendi o porque desses set's, sendo que, no atualizar tbm tem, e no excluir não necessita
            //t.setNome(nome.getText().toString());
            //t.setQtaula(Integer.parseInt(String.valueOf(qtAula.getText())));
            //t.setQthorasdisc(Integer.parseInt(String.valueOf(carga.getText())));
            //t.setSemestre((Integer) semestre.getSelectedItem());
            //t.setProfessor(prof.getText().toString());
            //t.setEmailProf(email.getText().toString());
            //t.setConteudo(conteudo.getText().toString());
            //int index = cDAO.verificarCodCurso(String.valueOf(curso.getSelectedItem()));
            //t.setCodcurso(index);


        }
    }
    // Metodo para pegar o index de um spinner pelo item selecionado
    private int getIndex(Spinner spinner, String myString)
    {
        int index = 0;

        for (int i=0; i<spinner.getCount(); i++){
            if ((spinner.getItemAtPosition(i).toString()).equals(myString)){
                index = i;
                i=spinner.getCount(); //will stop the loop, kind of break, by making condition false
            }
        }
        return index;
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        Bundle b = this.getIntent().getExtras();
        visible = b.getBoolean("visibilidade");

        getMenuInflater().inflate(R.menu.menu_disciplina_view, menu);

        menu.findItem(R.id.action_alter).setVisible(visible);
        menu.findItem(R.id.action_delete).setVisible(visible);

        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        switch (item.getItemId()) {
            case R.id.action_alter: {
                AlertDialog.Builder alert = new AlertDialog.Builder(this);
                alert.setTitle("Aviso");
                alert.setMessage("Deseja realmente alterar?");
                alert.setPositiveButton("Ok",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog,
                                                int whichButton) {
                                alter();
                            }
                        }
                );
                alert.setNegativeButton("Cancelar",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog,
                                                int whichButton) {
                                // nao faz nada
                            }
                        });
                alert.show();
            }
            return true;

            case R.id.action_delete: {
                AlertDialog.Builder alert = new AlertDialog.Builder(this);
                alert.setTitle("Aviso");
                alert.setMessage("Deseja realmente excluir?");
                alert.setPositiveButton("Ok",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog,
                                                int whichButton) {
                                delete();
                            }
                        }
                );
                alert.setNegativeButton("Cancelar",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog,
                                                int whichButton) {
                                // nao faz nada
                            }
                        });
                alert.show();
            }
            return true;

            default:
                return super.onOptionsItemSelected(item);
        }
    }

    private void delete(){
        TarefaDAO tarefaDAO = new TarefaDAO();
        //Verificação de Dependencias
        if (!tarefaDAO.selectDependenciasDisciplinas(cod)) {
            Disciplina t = new Disciplina();
            DisciplinaDAO tDAO = new DisciplinaDAO();
            t = tDAO.selectDiscplina(cod);
            int isDelete = tDAO.deleteDisciplina(t.getCoddisciplina().toString());
            if (isDelete == 1) {
                Toast.makeText(DisciplinaView.this, "Excluído com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            }
        }
        else
        {
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
            alertDialog.setTitle("Aviso");
            alertDialog.setMessage("Você possui Tarefa cadastrada com esta Disciplina!\n\nNão foi possivel excluir!");
            alertDialog.setPositiveButton("Ok",
                    new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog,
                                            int whichButton) {
                            finish();
                        }
                    }
            );
            alertDialog.show();
        }
    }

    private void alter(){
        if (!qtAula.getText().toString().equals("") && !carga.getText().toString().equals("")&& !nome.getText().toString().equals("")) {
            Disciplina t = new Disciplina();
            DisciplinaDAO dDAO = new DisciplinaDAO();
            t = dDAO.selectDiscplina(cod);
            CursoDAO cDAO = new CursoDAO();

            t.setCodcurso(cDAO.verificarCodCurso(String.valueOf(curso.getSelectedItem())));
            t.setNome(nome.getText().toString());
            t.setQtaula(Integer.parseInt(String.valueOf(qtAula.getText())));
            t.setQthorasdisc(Integer.parseInt(String.valueOf(carga.getText())));
            t.setSemestre((Integer) semestre.getSelectedItem());
            t.setProfessor(prof.getText().toString());
            t.setEmailProf(email.getText().toString());
            t.setConteudo(conteudo.getText().toString());

            boolean isUpdate = dDAO.updateDisciplina(t);

            if (isUpdate == true) {
                DiaDisciplinaDAO diaDAO = new DiaDisciplinaDAO();
                diaDAO.deleteDiaDisciplina(String.valueOf(cod));
                Toast.makeText(DisciplinaView.this, "Alterado com sucesso!", Toast.LENGTH_SHORT).show();
                salvarDia(cod);

                TarefaDAO tDAO = new TarefaDAO();
                tDAO.updateTarefaMetAval(cod);
                finish();
            } else {
                Toast.makeText(DisciplinaView.this, "Não alterado!", Toast.LENGTH_SHORT).show();
            }
        } else {
            Toast.makeText(DisciplinaView.this, "Insira os campos obrigatórios", Toast.LENGTH_SHORT).show();
            if(qtAula.getText().toString().equals(""))
                qtAula.setError("Campo Obrigatório");

            if(carga.getText().toString().equals(""))
                carga.setError("Campo Obrigatório");

            if(nome.getText().toString().equals(""))
                nome.setError("Campo Obrigatório");
        }
    }

    /*metodo que captura o pressionamento do botão VOLTAR gerado pelo codigo:
     getSupportActionBar().setDisplayHomeAsUpEnabled(true); gerado no Oncreate. */
    @Override
    public boolean onSupportNavigateUp(){
        TarefaDAO tDAO = new TarefaDAO();
        tDAO.deleteTarefaDisci();
        finish();
        return true;
    }

    // Metodo para gerar valores no spinner atraves do semestre registrado no curso;
    public void getSemestreValor() {

        curso.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                semList.clear();

                int sem = arrayAdapter.getItem(curso.getSelectedItemPosition()).getSemestre();
                for (int i = sem; i > 0; i--) {
                    semList.add(i);
                }

                arrayAdapter2 = new ArrayAdapter<Integer>(getContext(), android.R.layout.simple_spinner_dropdown_item, semList);
                arrayAdapter2.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

                semestre.setAdapter(arrayAdapter2);
            }
            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });
        }

    // Metodo genérico para pegar o contexto da activity
    // **Foi criado para evitar erros em lacos de repeticao que solicitam o contexto da activity em algum de seus comandos**
    public Context getContext() {
        return this;
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        TarefaDAO tDAO = new TarefaDAO();
        tDAO.deleteTarefaDisci();

    }

}
