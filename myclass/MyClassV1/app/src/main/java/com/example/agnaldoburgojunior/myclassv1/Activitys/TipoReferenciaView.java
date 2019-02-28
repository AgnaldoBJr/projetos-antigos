package com.example.agnaldoburgojunior.myclassv1.Activitys;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Controllers.ReferenciaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoReferenciaDAO;
import com.example.agnaldoburgojunior.myclassv1.Models.TipoReferencia;
import com.example.agnaldoburgojunior.myclassv1.R;

public class TipoReferenciaView extends AppCompatActivity {

    com.github.clans.fab.FloatingActionButton salva;
    EditText nome;

    int cod;
    boolean visible = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tipo_referencia_view);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        //this.getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_ALWAYS_HIDDEN);
       // InputMethodManager imm = (InputMethodManager) getSystemService(Context.INPUT_METHOD_SERVICE);
       // imm.toggleSoftInput (InputMethodManager.SHOW_FORCED, InputMethodManager.RESULT_HIDDEN);

        salva = (com.github.clans.fab.FloatingActionButton) findViewById(R.id.inserir_tipo_referencia);
        nome = (EditText) findViewById(R.id.nome_tipo_referencia);

        salva.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                TipoReferencia t = new TipoReferencia();
                t.setNome(nome.getText().toString());

                if (!nome.getText().toString().isEmpty()) {
                    TipoReferenciaDAO tipoReferenciaDAO = new TipoReferenciaDAO();
                    boolean isInserted = tipoReferenciaDAO.insertTipoReferencia(t);


                    if (isInserted == true) {
                        Toast.makeText(TipoReferenciaView.this, "Inserido com sucesso!", Toast.LENGTH_SHORT).show();
                        finish();
                    } else {
                        Toast.makeText(TipoReferenciaView.this, "Não inserido!", Toast.LENGTH_SHORT).show();
                    }
                } else {
                    nome.setError("Campo Obrigatório");
                    Toast.makeText(TipoReferenciaView.this, "Insira os campos obrigatórios", Toast.LENGTH_SHORT).show();
                }
            }

        });


    }

    @Override
    protected void onResume() {
        super.onResume();
        Bundle b = this.getIntent().getExtras();
        cod = b.getInt("cod");


        TipoReferencia t = new TipoReferencia();
        TipoReferenciaDAO tDAO = new TipoReferenciaDAO();
        t = tDAO.selectTipoReferencia(cod);

        if (cod != 0) {

            salva.setVisibility(View.INVISIBLE);
            nome.setText(t.getNome());
            t.setNome(nome.getText().toString());

        }
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        Bundle b = this.getIntent().getExtras();
        visible = b.getBoolean("visibilidade");

        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_tipo_ref_view, menu);

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
                            // Faz qualquer coisa
                        }
                    });
            alert.show();
            }
                return true;


            default:
                return super.onOptionsItemSelected(item);
        }
    }

    @Override
    public boolean onPrepareOptionsMenu(Menu menu) {

        return super.onPrepareOptionsMenu(menu);
    }

    public Activity getActivity() {
        return this;
    }

    private void delete() {

        ReferenciaDAO referenciaDAO = new ReferenciaDAO();

        if (!referenciaDAO.selectDependencias(cod)) {
            TipoReferencia t = new TipoReferencia();
            TipoReferenciaDAO tDAO = new TipoReferenciaDAO();
            t = tDAO.selectTipoReferencia(cod);

            int isDelete = tDAO.deleteTipoReferencia(t.getCodTipo().toString());


            if (isDelete == 1) {
                Toast.makeText(TipoReferenciaView.this, "Excluído com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            }
        }
        else
        {
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
            alertDialog.setTitle("Aviso");
            alertDialog.setMessage("Existe Referência cadastrada com este Tipo de Referência!\nNão foi possivel excluir!");
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


    private  void alter(){
        if (!nome.getText().toString().isEmpty()) {
            TipoReferencia t = new TipoReferencia();
            TipoReferenciaDAO tDAO = new TipoReferenciaDAO();
            t = tDAO.selectTipoReferencia(cod);
            t.setNome(nome.getText().toString());

            boolean isUpdate = tDAO.updateTipoReferencia(t);


            if (isUpdate == true) {
                Toast.makeText(TipoReferenciaView.this, "Alterado com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            } else {
                Toast.makeText(TipoReferenciaView.this, "Não alterado!", Toast.LENGTH_SHORT).show();
            }
        } else {
            Toast.makeText(TipoReferenciaView.this, "Insira os campos obrigatórios", Toast.LENGTH_SHORT).show();
            nome.setError("Campo Obrigatório");
        }
    }

    @Override
    public boolean onSupportNavigateUp(){
        finish();
        return true;
    }
}
