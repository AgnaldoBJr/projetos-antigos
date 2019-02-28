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
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.inputmethod.InputMethodManager;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Controllers.DisciplinaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.FaltaDAO;
import com.example.agnaldoburgojunior.myclassv1.Custom.DateDialog;
import com.example.agnaldoburgojunior.myclassv1.Models.Disciplina;
import com.example.agnaldoburgojunior.myclassv1.Models.Falta;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Locale;

public class FaltaView extends AppCompatActivity {

    private EditText qtdFalta;
    private EditText motivo;
    private EditText data;
    private Spinner disc;
    private com.github.clans.fab.FloatingActionButton inserir;


    ArrayAdapter<Disciplina> arrayAdapter;
    DisciplinaDAO dDAO = new DisciplinaDAO();

    int cod;
    boolean visible = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_falta_view);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        qtdFalta = (EditText) findViewById(R.id.qtdfalta);
        motivo = (EditText) findViewById(R.id.faltamotivo);
        data = (EditText) findViewById(R.id.data_falta);
        disc = (Spinner) findViewById(R.id.spinnerDisciplina);
        inserir = (com.github.clans.fab.FloatingActionButton) findViewById(R.id.inserirFalta);


        //seta data do sistema no campo de data
        data.setText(new SimpleDateFormat("dd-MM-yyyy", Locale.US).format(new Date()));

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
        List<Disciplina> d = dDAO.selectTodosDisciplina();
        arrayAdapter  = new ArrayAdapter<Disciplina>(this, android.R.layout.simple_spinner_dropdown_item, d);
        arrayAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        disc.setAdapter(arrayAdapter);

        qtdFalta.setText("0");

        if(!arrayAdapter.isEmpty()) {
            inserir.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    int index = dDAO.verificarCodSisciplina(String.valueOf(disc.getSelectedItem()));
                    System.out.println(index);
                    Falta f = new Falta();
                    f.setCoddisciplina(index);
                    f.setData(data.getText().toString());
                    f.setMotivo(motivo.getText().toString());

                    int qt = Integer.parseInt(qtdFalta.getText().toString());

                    if (!(qt < 0) && !(qt == 0))
                        f.setQtfaltas(qt);
                    else
                        qt = 0;



                    if (!(Integer.parseInt(qtdFalta.getText().toString()) == 0)) {
                        FaltaDAO fDAO = new FaltaDAO();
                        System.out.println("Teste");
                        boolean isInserted = fDAO.insertFalta(f);
                        System.out.println(isInserted);
                        if (isInserted == true) {
                            Toast.makeText(getApplicationContext(), "Inserido com Sucesso", Toast.LENGTH_SHORT).show();
                            finish();
                        } else {
                            Toast.makeText(getApplicationContext(), "Não Inserido", Toast.LENGTH_SHORT).show();
                        }
                    } else {
                        if ((Integer.parseInt(qtdFalta.getText().toString()) == 0))
                            qtdFalta.setError("Campo deve conter valores maiores que 0!");
                    }
                }
            });
        }else{
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
    }

    @Override
    protected void onResume() {
        super.onResume();

        Bundle b = this.getIntent().getExtras();
        cod = b.getInt("cod");

        Falta f = new Falta();
        FaltaDAO fDAO = new FaltaDAO();
        f = fDAO.selectFalta(cod);

        if(cod!=0){
            data.setText(f.getData());
            motivo.setText(f.getMotivo());
            qtdFalta.setText(f.getQtfaltas().toString());
            disc.setSelection(getIndex(disc, dDAO.verificarNomeDisciplina(f.getCoddisciplina())));

            int index = dDAO.verificarCodSisciplina(String.valueOf(disc.getSelectedItem()));
            System.out.println(index);
            f.setCoddisciplina(index);
            f.setData(data.getText().toString());
            f.setMotivo(motivo.getText().toString());
            f.setQtfaltas(Integer.parseInt(qtdFalta.getText().toString()));
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
        Bundle b = this.getIntent().getExtras();
        visible = b.getBoolean("visibilidade");

        getMenuInflater().inflate(R.menu.menu_falta_view, menu);

        menu.findItem(R.id.action_alter).setVisible(visible);
        menu.findItem(R.id.action_delete).setVisible(visible);

        return true;
    }

    @TargetApi(Build.VERSION_CODES.M)
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

    private void alter() {
        Falta f = new Falta();
        FaltaDAO fDAO = new FaltaDAO();
        f = fDAO.selectFalta(cod);

        if (!(Integer.parseInt(qtdFalta.getText().toString()) == 0)) {

            int index = dDAO.verificarCodSisciplina(String.valueOf(disc.getSelectedItem()));
            f.setCoddisciplina(index);
            f.setData(data.getText().toString());
            f.setMotivo(motivo.getText().toString());

            int qt = Integer.parseInt(qtdFalta.getText().toString());

            if (!(qt < 0) && !(qt == 0))
                f.setQtfaltas(qt);
            else
                qt = 0;

            boolean isUpdated = fDAO.updateFalta(f);
            System.out.println("update "+isUpdated);
            if (isUpdated == true) {
                Toast.makeText(getApplicationContext(), "Atualizado com Sucesso", Toast.LENGTH_SHORT).show();
                finish();
            } else {
                Toast.makeText(getApplicationContext(), "Não Atualizado", Toast.LENGTH_SHORT).show();
            }
        } else {
            if ((Integer.parseInt(qtdFalta.getText().toString()) == 0))
                qtdFalta.setError("Campo deve conter valores maiores que 0!");
        }

    }

    private void delete() {
        FaltaDAO fDAO = new FaltaDAO();
        Falta f;

        f = fDAO.selectFalta(cod);
        System.out.println(cod);

        int isDelete = fDAO.deleteFalta(f.getCodfalta().toString());

        if (isDelete == 1) {
            Toast.makeText(FaltaView.this, "Excluído com sucesso!", Toast.LENGTH_SHORT).show();
            finish();
        }
    }

    public Context getActivity() {
        return this;
    }

    @Override
    public boolean onSupportNavigateUp(){
        finish();
        return true;
    }
}
