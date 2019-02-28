package com.example.agnaldoburgojunior.myclassv1.Activitys;

import android.app.AlertDialog;
import android.app.FragmentTransaction;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.inputmethod.InputMethodManager;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Controllers.ReferenciaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoReferenciaDAO;
import com.example.agnaldoburgojunior.myclassv1.Custom.DateDialog;
import com.example.agnaldoburgojunior.myclassv1.Models.Referencia;
import com.example.agnaldoburgojunior.myclassv1.Models.TipoReferencia;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;

public class ReferenciaView extends AppCompatActivity {

    private Spinner tipoRef;
    private EditText titulo;
    private EditText autor;
    private EditText edicao;
    private EditText ano;
    private EditText url;
    private EditText acesso;
    private EditText comentarios;
    private com.github.clans.fab.FloatingActionButton inserir;

    private Referencia referencia;
    ArrayAdapter<TipoReferencia> arrayAdapter;
    ArrayAdapter arrayAdapterAux;
    boolean visible = false;
    int cod;

    TipoReferenciaDAO trDAO = new TipoReferenciaDAO();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_referencia_view);

        //chama o botão de voltar
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        tipoRef = (Spinner) findViewById(R.id.spinner_tiporef_em_referencias);
        titulo = (EditText) findViewById(R.id.titulo_ref);
        autor = (EditText) findViewById(R.id.autor_ref);
        edicao = (EditText) findViewById(R.id.edicao_ref);
        ano = (EditText) findViewById(R.id.ano_ref);
        url = (EditText) findViewById(R.id.url_ref);
        acesso = (EditText) findViewById(R.id.ac_ref);
        comentarios = (EditText) findViewById(R.id.comentarios_ref);
        inserir = (com.github.clans.fab.FloatingActionButton) findViewById(R.id.inserir_ref);

        acesso.setText(new SimpleDateFormat("dd-MM-yyyy").format(new Date()));
        //Setando o Spinner Tipo de Referncia

        List<TipoReferencia> tr = trDAO.selectTodosTipoReferencia();
        arrayAdapter = new ArrayAdapter<TipoReferencia>(this, android.R.layout.simple_spinner_dropdown_item, tr);
        tipoRef.setAdapter(arrayAdapter);

        if(!arrayAdapter.isEmpty()) {

            inserir.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    //Setando os campos a serem inseridos
                    referencia = new Referencia();

                    int index = trDAO.verificarCodTipoRef(tipoRef.getSelectedItem().toString());
                    System.out.println(index);
                    System.out.println(tipoRef.getSelectedItem().toString());
                    referencia.setCodtipo(index);
                    referencia.setTitulo(titulo.getText().toString());
                    referencia.setAutor(autor.getText().toString());
                    referencia.setEdicao(edicao.getText().toString());
                    referencia.setAno(ano.getText().toString());
                    referencia.setUrl(url.getText().toString());
                    referencia.setDataacesso(acesso.getText().toString());
                    referencia.setComentarios(comentarios.getText().toString());


                    if (!titulo.getText().toString().isEmpty()) {

                        ReferenciaDAO rDAO = new ReferenciaDAO();
                        boolean isInserted = rDAO.insertReferencia(referencia);

                        if (isInserted == true) {
                            Toast.makeText(ReferenciaView.this, "Inserido com sucesso!", Toast.LENGTH_LONG).show();
                            finish();
                        } else {
                            Toast.makeText(ReferenciaView.this, "Não inserido!", Toast.LENGTH_LONG).show();
                        }
                    } else {
                        Toast.makeText(ReferenciaView.this, "Insira os campos obrigatórios", Toast.LENGTH_SHORT).show();
                        titulo.setError("Campo Obrigatório");
                    }
                }

            });

        }else{
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
            alertDialog.setTitle("Aviso");
            alertDialog.setCancelable(false);
            alertDialog.setMessage("Você não possui Tipos de Referência cadastrados!\n Deseja cadastrar?");
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
                            Intent myIntent = new Intent(getApplicationContext(), TipoReferenciaView.class);
                            Bundle b = new Bundle();
                            b.putInt("codigoTipoRef", 0);
                            myIntent.putExtras(b);
                            startActivity(myIntent);

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


        Referencia t = new Referencia();
        ReferenciaDAO tDAO = new ReferenciaDAO();
        t = tDAO.selectReferencia(cod);

        if (cod != 0) {

            String tp = String.valueOf(trDAO.verificarNomeTipoRef(t.getCodtipo()));
            System.out.println("nome index " + tp);

            inserir.setVisibility(View.INVISIBLE);


            tipoRef.setSelection(getIndex(tipoRef, tp));
            titulo.setText(t.getTitulo());
            autor.setText(t.getAutor());
            edicao.setText(String.valueOf(t.getEdicao()));
            ano.setText(String.valueOf(t.getAno()));
            url.setText(t.getUrl());
            //acesso.setText(new SimpleDateFormat("dd-MM-yyyy", Locale.US).format(t.getDataacesso()));
            comentarios.setText(t.getComentarios());


            t.setTitulo(titulo.getText().toString());
            t.setAutor(autor.getText().toString());
            t.setEdicao(edicao.getText().toString());
            t.setAno(ano.getText().toString());
            t.setUrl(url.getText().toString());
            t.setDataacesso(t.getDataacesso());
            t.setComentarios(comentarios.getText().toString());

            int index = trDAO.verificarCodTipoRef(tipoRef.getSelectedItem().toString());
            t.setCodtipo(index);

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

        getMenuInflater().inflate(R.menu.menu_referencia_view, menu);

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
                                // Nenhuma ação
                            }
                        });
                alert.show();
            }
            return true;


            default:
                return super.onOptionsItemSelected(item);
        }
    }

    public void onStart() {
        super.onStart();

        EditText txtDate = (EditText) findViewById(R.id.ac_ref);

        txtDate.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                InputMethodManager imm = (InputMethodManager) getActivity().getSystemService(Context.INPUT_METHOD_SERVICE);
                imm.hideSoftInputFromWindow(v.getWindowToken(), 0);

                DateDialog dialog = new DateDialog(v);
                FragmentTransaction ft = getFragmentManager().beginTransaction();
                dialog.show(ft, "DatePicker");
            }
        });

    }

    public Context getActivity() {
        return this;
    }

    public void delete(){

            Referencia t = new Referencia();
            ReferenciaDAO tDAO = new ReferenciaDAO();
            t = tDAO.selectReferencia(cod);

            int isDelete = tDAO.deleteReferencia(t.getCodreferncias().toString());


            if (isDelete == 1) {
                Toast.makeText(ReferenciaView.this, "Excluído com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            } else {
                Toast.makeText(ReferenciaView.this, "Não excluído!", Toast.LENGTH_SHORT).show();
            }
        }

    public  void alter(){
        if (!titulo.getText().toString().isEmpty()) {
            Referencia t = new Referencia();
            ReferenciaDAO tDAO = new ReferenciaDAO();
            t = tDAO.selectReferencia(cod);//

            int index = trDAO.verificarCodTipoRef((tipoRef.getSelectedItem().toString()));
            System.out.println("alteracao index: " + index);
            t.setCodtipo(index);
            t.setTitulo(titulo.getText().toString());
            t.setAutor(autor.getText().toString());
            t.setEdicao(edicao.getText().toString());
            t.setAno(ano.getText().toString());
            t.setUrl(url.getText().toString());
            t.setDataacesso(acesso.getText().toString());
            t.setComentarios(comentarios.getText().toString());

            boolean isUpdate = tDAO.updateReferencia(t);


            if (isUpdate == true) {
                Toast.makeText(ReferenciaView.this, "Alterado com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            } else {
                Toast.makeText(ReferenciaView.this, "Não alterado!", Toast.LENGTH_SHORT).show();
            }
        } else {
            Toast.makeText(ReferenciaView.this, "Insira os campos obrigatórios", Toast.LENGTH_SHORT).show();
            titulo.setError("Campo Obrigatório");
        }
    }

    @Override
    public boolean onSupportNavigateUp(){
        finish();
        return true;
    }
}

