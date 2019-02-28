package com.example.agnaldoburgojunior.myclassv1.Activitys;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Controllers.TarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoTarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Models.TipoDeTarefa;
import com.example.agnaldoburgojunior.myclassv1.R;

public class TipoDeTarefaView extends AppCompatActivity {

    com.github.clans.fab.FloatingActionButton salva;
    EditText nome;

    boolean visible;
    int cod;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tipo_de_tarefa_view);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        salva = (com.github.clans.fab.FloatingActionButton) findViewById(R.id.inserir_tipo_tarefa);
        nome = (EditText) findViewById(R.id.nome_tipo_tarefa);


        salva.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                TipoDeTarefa t = new TipoDeTarefa();
                t.setTiponome(nome.getText().toString());

                if(!nome.getText().toString().isEmpty()) {
                    TipoTarefaDAO tipoDeTarefaDAO = new TipoTarefaDAO();
                    boolean isInserted = tipoDeTarefaDAO.insertTipoTarefa(t);

                    if (isInserted == true) {
                        Toast.makeText(TipoDeTarefaView.this, "Inserido com sucesso!", Toast.LENGTH_LONG).show();
                        finish();
                    } else {
                        Toast.makeText(TipoDeTarefaView.this, "Não inserido!", Toast.LENGTH_LONG).show();
                    }
                }
                else{
                    nome.setError("Campo Obrigatório");
                    Toast.makeText(TipoDeTarefaView.this, "Insira os campos obrigatórios", Toast.LENGTH_SHORT).show();
                }
            }

        });
    }

    @Override
    protected void onResume() {
        super.onResume();
        Bundle b = this.getIntent().getExtras();
        cod = b.getInt("cod");


        TipoDeTarefa t = new TipoDeTarefa();
        TipoTarefaDAO tDAO = new TipoTarefaDAO();
        t = tDAO.selectTipoTarefa(cod);

        if (cod != 0) {

            salva.setVisibility(View.INVISIBLE);
            nome.setText(t.getTiponome());
            t.setTiponome(nome.getText().toString());

        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        Bundle b = this.getIntent().getExtras();
        visible = b.getBoolean("visibilidade");

        getMenuInflater().inflate(R.menu.menu_tipo_de_tarefa_view, menu);

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

    private void delete(){
        TarefaDAO tarefaDAO = new TarefaDAO();
        if (!tarefaDAO.selectDependenciasTipoTarefa(cod)) {
            TipoDeTarefa t = new TipoDeTarefa();
            TipoTarefaDAO tDAO = new TipoTarefaDAO();
            t = tDAO.selectTipoTarefa(cod);

            int isDelete = tDAO.deleteTipoTarefa(t.getCodtipodetarefa().toString());


            if (isDelete == 1) {
                Toast.makeText(TipoDeTarefaView.this, "Excluído com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            } else {
                Toast.makeText(TipoDeTarefaView.this, "Não excluído!", Toast.LENGTH_SHORT).show();
            }
        }
            else
            {
                AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
                alertDialog.setTitle("Aviso");
                alertDialog.setMessage("Existe Tarefas cadastradas com este Tipo de Tarefa!\nNão foi possivel excluir!");
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
            TipoDeTarefa t = new TipoDeTarefa();
            TipoTarefaDAO tDAO = new TipoTarefaDAO();
            t = tDAO.selectTipoTarefa(cod);
            t.setTiponome(nome.getText().toString());

            boolean isUpdate = tDAO.updateTipoTarefa(t);


            if (isUpdate == true) {
                Toast.makeText(TipoDeTarefaView.this, "Alterado com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            } else {
                Toast.makeText(TipoDeTarefaView.this, "Não alterado!", Toast.LENGTH_SHORT).show();
            }
        } else {
            Toast.makeText(TipoDeTarefaView.this, "Insira os campos obrigatórios", Toast.LENGTH_SHORT).show();
            nome.setError("Campo Obrigatório");
        }
    }

    @Override
    public boolean onSupportNavigateUp(){
        finish();
        return true;
    }
}
