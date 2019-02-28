package com.example.agnaldoburgojunior.myclassv1.Activitys;

import android.annotation.TargetApi;
import android.app.AlertDialog;
import android.app.FragmentTransaction;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.TextWatcher;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.inputmethod.InputMethodManager;
import android.widget.ArrayAdapter;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Controllers.DisciplinaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoTarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Custom.DateDialog;
import com.example.agnaldoburgojunior.myclassv1.Models.Disciplina;
import com.example.agnaldoburgojunior.myclassv1.Models.Tarefa;
import com.example.agnaldoburgojunior.myclassv1.Models.TipoDeTarefa;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Locale;

public class TarefaView extends AppCompatActivity {

    private Spinner disciplina;
    private Spinner tipoTarefa;
    private EditText nome;
    private EditText assunto;
    private EditText data;
    private EditText descricao;
    private EditText nota;
    private CheckBox status;
    private com.github.clans.fab.FloatingActionButton inserir;
    private TextWatcher valornota;

    ArrayAdapter<Disciplina> arrayAdapter;
    ArrayAdapter<TipoDeTarefa> arrayAdapter2;

    Tarefa tarefa;
    int cod;
    boolean visible =false;

    TipoTarefaDAO tipoDAO = new TipoTarefaDAO();
    DisciplinaDAO dDAO = new DisciplinaDAO();
    SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
    @TargetApi(Build.VERSION_CODES.M)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tarefa_view);


        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        disciplina = (Spinner) findViewById(R.id.spinner_disc_em_tarefa);
        tipoTarefa = (Spinner) findViewById(R.id.spinner_tipotar_em_tarefa);
        nome = (EditText) findViewById(R.id.nome_tarefa);
        assunto = (EditText) findViewById(R.id.assunto_tarefa);
        data = (EditText) findViewById(R.id.data_tarefa);
        descricao = (EditText) findViewById(R.id.descricao_tarefa);
        nota = (EditText) findViewById(R.id.nota_tarefa);
        inserir = (com.github.clans.fab.FloatingActionButton) findViewById(R.id.inserir_tarefa);
        status =  (CheckBox) findViewById(R.id.status_tarefa);

        data.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                InputMethodManager imm = (InputMethodManager) getActivity().getSystemService(Context.INPUT_METHOD_SERVICE);
                imm.hideSoftInputFromWindow(v.getWindowToken(), 0);

                DateDialog dialog = new DateDialog(v);
                FragmentTransaction ft = getFragmentManager().beginTransaction();
                dialog.show(ft, "DatePicker");
            }
        });

        //Setar os valores para o Spinner Disciplina
        List<Disciplina> d = dDAO.selectTodosDisciplina();
        arrayAdapter  = new ArrayAdapter<Disciplina>(this, android.R.layout.simple_spinner_dropdown_item, d);
        arrayAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        disciplina.setAdapter(arrayAdapter);


        //Setar os valores para o Spinner Tipo de Tarefa
        List<TipoDeTarefa> l = tipoDAO.selectTodosTipoTarefa();
        arrayAdapter2  = new ArrayAdapter<TipoDeTarefa>(this, android.R.layout.simple_spinner_dropdown_item, l);
        arrayAdapter2.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        tipoTarefa.setAdapter(arrayAdapter2);

        //seta data do sistema no campo de data
        data.setText(new SimpleDateFormat("dd-MM-yyyy", Locale.US).format(new Date()));


        //Adicionando uma mascara no EditText para tratar as notas
       // nota.addTextChangedListener(Mask.insert("00.0", nota));


        if(!arrayAdapter.isEmpty() && !arrayAdapter2.isEmpty()) {
            //Botão inserir
            inserir.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    //Setar os campos do objeto
                    tarefa = new Tarefa();
                    int index = tipoDAO.verificarCodTipoRef(String.valueOf(tipoTarefa.getSelectedItem()));
                    int index2 = dDAO.verificarCodSisciplina(String.valueOf(disciplina.getSelectedItem()));

                    tarefa.setCoddisciplina(index2);
                    tarefa.setCodtipotarefa(index);
                    tarefa.setNome(nome.getText().toString());
                    tarefa.setAssunto(assunto.getText().toString());
                    Date dt;
                    String kk = null;
                    try {
                        dt = new SimpleDateFormat("dd-MM-yyyy",Locale.US).parse(data.getText().toString());
                        kk = format.format(dt);
                    } catch (ParseException e) {
                        e.printStackTrace();
                    }


                    tarefa.setData(kk);
                    tarefa.setDescricao(descricao.getText().toString());
                    tarefa.setPeso(0f);

                    float n = 0;
                    if(nota.getText().toString().length()==0){
                        tarefa.setNota(0f);}
                    else{
                         n = Float.parseFloat(nota.getText().toString());
                        tarefa.setNota(n);
                    }

                    if(status.isChecked() || (nota.getText().toString().length()>0))
                        tarefa.setStatus(0);
                    else
                        tarefa.setStatus(4);

                    if (!nome.getText().toString().isEmpty() && (!(n > 10.0f) && !(n <0f)))

                    {

                        TarefaDAO tarefaDAO = new TarefaDAO();
                        boolean isInserted = tarefaDAO.insertTarefa(tarefa);

                        if (isInserted) {
                            Toast.makeText(TarefaView.this, "Inserido com sucesso!", Toast.LENGTH_LONG).show();
                            finish();
                        } else {
                            Toast.makeText(TarefaView.this, "Não inserido!", Toast.LENGTH_LONG).show();
                        }
                    } else {
                        Toast.makeText(TarefaView.this, "Insira o campo obrigatório", Toast.LENGTH_SHORT).show();
                        if(nome.getText().toString().equals(""))
                        nome.setError("Campo Obrigatório");
                        if(n> 10.0f || n<0f ){
                          String msg = "Este campo deve conter números de 0 a 10!\nEx: 07.5";
                            nota.setError(msg);
                        }

                    }
                }
            });
        }
         if(arrayAdapter2.isEmpty()){
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
            alertDialog.setTitle("Aviso");
             alertDialog.setCancelable(false);
            alertDialog.setMessage("Você não possui Tipos de Tarefas cadastrados!\nDeseja Cadastrar?!");
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
                            Intent myIntent = new Intent(getApplicationContext(), TipoDeTarefaView.class);
                            Bundle b = new Bundle();
                            b.putInt("codtipodetarefa", 0);
                            myIntent.putExtras(b);
                            startActivity(myIntent);

                        }
                    }
            );
            alertDialog.show();
        }
        if(arrayAdapter.isEmpty()){
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
            alertDialog.setTitle("Aviso");
            alertDialog.setCancelable(false);
            alertDialog.setMessage("Você não possui Disciplinas cadastrados!\nDeseja Cadastrar?!");
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
                            Intent myIntent = new Intent(getApplicationContext(), DisciplinaView.class);
                            Bundle b = new Bundle();
                            b.putInt("coddisciplina", 0);
                            myIntent.putExtras(b);
                            startActivity(myIntent);

                        }
                    }
            );
            alertDialog.show();
        }
        if(arrayAdapter.isEmpty() && arrayAdapter2.isEmpty()){
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
            alertDialog.setTitle("Aviso");
            alertDialog.setCancelable(false);
            alertDialog.setMessage("Você não possui Tipos de Tarefas e Disciplinas cadastrados!\n\nRealize o cadastro, e tente novamente!");
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

    @Override
    protected void onResume() {
        super.onResume();
        Bundle b = this.getIntent().getExtras();
        cod = b.getInt("cod");

        Tarefa t = new Tarefa();
        TarefaDAO tDAO = new TarefaDAO();
        t = tDAO.selectTarefa(cod);
        nota.refreshDrawableState();
        if (cod != 0) {

            inserir.setVisibility(View.INVISIBLE);

            String c = String.valueOf(tipoDAO.verificarNomeTipoTar(t.getCodtipotarefa()));
            String d = String.valueOf(dDAO.verificarNomeDisciplina(t.getCoddisciplina()));

            if(t.getStatus()==0)
                status.setChecked(true);

            disciplina.setSelection(getIndex(disciplina, d));
            tipoTarefa.setSelection(getIndex(tipoTarefa, c));
            nome.setText(t.getNome());
            assunto.setText(t.getAssunto());
            try {
                Date dt = new SimpleDateFormat("yyyy-MM-dd",Locale.US).parse(t.getData());
                String kk = new SimpleDateFormat("dd-MM-yyyy",Locale.US).format(dt);
                data.setText(kk);
            } catch (ParseException e) {
                e.printStackTrace();
            }
            descricao.setText(t.getDescricao());

            ////Formatacao do valor float do banco para adicionar um 0 nos inteiros e tratar corretamente a mascara de nota
            //DecimalFormatSymbols otherSymbols = new DecimalFormatSymbols(Locale.US);
            //otherSymbols.setDecimalSeparator('.');
           // otherSymbols.setGroupingSeparator(',');
           // DecimalFormat df = new DecimalFormat("##.#",otherSymbols);
           // df.setMaximumFractionDigits(1);
           // df.setMinimumIntegerDigits(2);

            nota.setText(String.valueOf(t.getNota()));
            t.setNome(nome.getText().toString());
            t.setAssunto(assunto.getText().toString());
            t.setData(data.getText().toString());
            t.setDescricao(descricao.getText().toString());
            t.setNota(Float.parseFloat(nota.getText().toString()));
            int index = tipoDAO.verificarCodTipoRef(String.valueOf(tipoTarefa.getSelectedItem()));
            int index2 = dDAO.verificarCodSisciplina(String.valueOf(disciplina.getSelectedItem()));
            t.setCoddisciplina(index2);
            t.setCodtipotarefa(index);
        }

    }


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

            getMenuInflater().inflate(R.menu.menu_tarefa_view, menu);

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



    public Context getActivity() {
        return this;
    }

    private void delete(){
        TarefaDAO tDAO = new TarefaDAO();
        Tarefa t;

            t = tDAO.selectTarefa(cod);

            int isDelete = tDAO.deleteTarefa(t.getCodtarefa().toString());

            if (isDelete == 1) {
                Toast.makeText(TarefaView.this, "Excluído com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            }
    }

    private void alter(){
            Tarefa t;
            TarefaDAO tDAO = new TarefaDAO();
            t = tDAO.selectTarefa(cod);
        float n = 0;


        if(nota.getText().toString().length()==0){
            t.setNota(0f);}
        else{
            n = Float.parseFloat(nota.getText().toString());
            t.setNota(n);
        }

        if(status.isChecked() || (Float.parseFloat(nota.getText().toString())>0))
            t.setStatus(0);
        else
            t.setStatus(4);

        int index = tipoDAO.verificarCodTipoRef(String.valueOf(tipoTarefa.getSelectedItem()));
        int index2 = dDAO.verificarCodSisciplina(String.valueOf(disciplina.getSelectedItem()));
        t.setCoddisciplina(index2);
        t.setCodtipotarefa(index);
        t.setNome(nome.getText().toString());
        t.setAssunto(assunto.getText().toString());
        Date dt;
        String kk = null;
        try {
            dt = new SimpleDateFormat("dd-MM-yyyy",Locale.US).parse(data.getText().toString());
            kk = format.format(dt);
        } catch (ParseException e) {
            e.printStackTrace();
        }
        t.setData(kk);
        t.setDescricao(descricao.getText().toString());

        if (!nome.getText().toString().isEmpty() && (!(n > 10.0f) && !(n <0f))) {
            boolean isUpdate = tDAO.updateTarefa(t);

            if (isUpdate == true) {
                Toast.makeText(TarefaView.this, "Alterado com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            } else {
                Toast.makeText(TarefaView.this, "Não alterado!", Toast.LENGTH_SHORT).show();
            }
        } else {
            Toast.makeText(TarefaView.this, "Insira os campos obrigatórios", Toast.LENGTH_SHORT).show();
            if(nome.getText().toString().equals(""))
                nome.setError("Campo Obrigatório");
            if(n> 10.0f || n<0f ){
                String msg = "Este campo deve conter números de 0 a 10!\nEx: 07.5";
                nota.setError(msg);
            }
        }
    }

    @Override
    public boolean onSupportNavigateUp(){
        finish();
        return true;
    }


}

