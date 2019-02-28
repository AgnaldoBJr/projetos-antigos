package com.example.agnaldoburgojunior.myclassv1.Activitys;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Controllers.CursoDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.DisciplinaDAO;
import com.example.agnaldoburgojunior.myclassv1.Models.Curso;
import com.example.agnaldoburgojunior.myclassv1.R;


public class CursoView extends AppCompatActivity {

    String[] turno = new String[]{"Manhã", "Tarde", "Noite"};
    String[] porc = new String[]{"50", "60", "70", "75", "80", "85", "90", "100"};
    String[] semestre = new String[]{"1", "2", "3", "4", "5", "6", "7", "8", "9", "10"};

    Spinner sTurno;
    EditText sPorc;
    EditText sMedia;
    Spinner sSemestre;
    EditText nome;
    EditText ra;
    EditText instituicao;
    com.github.clans.fab.FloatingActionButton inserir;

    ArrayAdapter<String> ad1;
    ArrayAdapter<String> ad2;
    ArrayAdapter<String> ad3;


    boolean visible = false;
    int cod;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_curso_view);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        sTurno = (Spinner) findViewById(R.id.spinner_turno);
        sPorc = (EditText) findViewById(R.id.aprov);
        sMedia = (EditText) findViewById(R.id.media);
        sSemestre = (Spinner) findViewById(R.id.spinner_semestre);
        nome = (EditText) findViewById(R.id.nome_curso);
        ra = (EditText) findViewById(R.id.ra_curso);
        instituicao = (EditText) findViewById(R.id.instituicao_curso);
        inserir = (com.github.clans.fab.FloatingActionButton) findViewById(R.id.inserir_curso);


        //Carregando os Spinners
        ad1 = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_dropdown_item, turno);
        ad1.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        sTurno.setAdapter(ad1);

        ad3 = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_dropdown_item, semestre);
        ad3.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        sSemestre.setAdapter(ad3);

        inserir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Curso curso = new Curso();


                int media;

                if (sMedia.getText().toString().isEmpty())
                    media = 0;
                else
                    media = Integer.parseInt(sMedia.getText().toString());


                int porc;

                if (sPorc.getText().toString().isEmpty())
                    porc = 0;
                else
                    porc = Integer.parseInt(sPorc.getText().toString());

                curso.setCursonome(nome.getText().toString());
                curso.setInstituicao(instituicao.getText().toString());
                curso.setTurno(ad1.getItem(sTurno.getSelectedItemPosition()));
                curso.setSemestre(Integer.parseInt(ad3.getItem(sSemestre.getSelectedItemPosition())));
                curso.setPorcaprovacao(porc);
                curso.setMediaaprov(media);

                int r = 0;
                if(ra.getText().toString().isEmpty())
                r=0;
                else
                r = Integer.parseInt(ra.getText().toString());

                curso.setRa(r);

                if (!nome.getText().toString().equals("") && !ra.getText().toString().equals("") && ((!sPorc.getText().toString().equals(""))
                        && (!(porc >100)) && (!(porc<0))) && ((!sPorc.getText().toString().equals("") && (!(media<0)) && (!(media>10)) ))){

                    CursoDAO c = new CursoDAO();
                    boolean i = c.insertCurso(curso);

                    if (i == true) {
                        Toast.makeText(CursoView.this, "Inserido com sucesso!", Toast.LENGTH_SHORT).show();
                        finish();
                    } else {
                        Toast.makeText(CursoView.this, "Não inserido!", Toast.LENGTH_SHORT).show();
                    }
                } else {
                    Toast.makeText(CursoView.this, "Insira os Campos Obrigatórios!", Toast.LENGTH_SHORT).show();
                    if (nome.getText().toString().equals(""))
                        nome.setError("Campo Obrigatório");
                    if (ra.getText().toString().equals(""))
                        ra.setError("Campo Obrigatório");

                    if (sPorc.getText().toString().equals(""))
                        sPorc.setError("Campo Obrigatório");
                    if((porc>100) || (porc<0))
                        sPorc.setError("A porcentagem de aprovação deve ser de 0 a 100%");

                    if (sMedia.getText().toString().equals(""))
                        sMedia.setError("Campo Obrigatório");
                    if((media>100) || (media<0))
                        sMedia.setError("A média de aprovação deve ser de 0 a 10");
                }
            }
        });
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        Bundle b = this.getIntent().getExtras();
        visible = b.getBoolean("visibilidade");

        getMenuInflater().inflate(R.menu.menu_curso_view, menu);

        menu.findItem(R.id.action_alter).setVisible(visible);
        menu.findItem(R.id.action_delete).setVisible(visible);

        return true;
    }

    @Override
    protected void onResume() {
        super.onResume();
        Bundle b = this.getIntent().getExtras();
        cod = b.getInt("cod");


        Curso c = new Curso();
        CursoDAO tDAO = new CursoDAO();
        c = tDAO.selectCurso(cod);

        if (cod != 0) {

            inserir.setVisibility(View.INVISIBLE);

            sTurno.setSelection(ad1.getPosition(c.getTurno()));
            sPorc.setText(c.getPorcaprovacao().toString());
            sSemestre.setSelection(ad3.getPosition(String.valueOf(c.getSemestre())));
            nome.setText(c.getCursonome());
            ra.setText(c.getRa().toString());
            instituicao.setText(c.getInstituicao());
            sMedia.setText(c.getMediaaprov().toString());

            c.setMediaaprov(Integer.parseInt(sMedia.getText().toString()));
            c.setCursonome(nome.getText().toString());
            c.setRa(Integer.parseInt(ra.getText().toString()));
            c.setInstituicao(instituicao.getText().toString());
            c.setTurno(ad1.getItem(sTurno.getSelectedItemPosition()));
            c.setSemestre(Integer.parseInt(ad3.getItem(sSemestre.getSelectedItemPosition())));
            c.setPorcaprovacao(Integer.parseInt(sPorc.getText().toString()));


        }
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

    public void delete(){

        DisciplinaDAO disciplinaDAO = new DisciplinaDAO();

        if (!disciplinaDAO.selectDependenciasCurso(cod)) {
            Curso c = new Curso();
            CursoDAO cDAO = new CursoDAO();
            c = cDAO.selectCurso(cod);

            int isDelete = cDAO.deleteCurso(String.valueOf(c.getCodcurso()));

            if (isDelete == 1) {
                Toast.makeText(CursoView.this, "Excluído com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            }
        }
        else
        {
            AlertDialog.Builder alertDialog = new AlertDialog.Builder(this);
            alertDialog.setTitle("Aviso");
            alertDialog.setMessage("Existe Disciplina cadastrada com este Curso!\nNão foi possível excluir!");
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

    public  void alter(){
        Curso c;
        CursoDAO cDAO = new CursoDAO();
        c = cDAO.selectCurso(cod);
        int media=0;

        if (sMedia.getText().toString().isEmpty())
            media=0;
        else
            media = Integer.parseInt(sMedia.getText().toString());


        int porc;

        if (sPorc.getText().toString().isEmpty())
            porc = 0;
        else
            porc = Integer.parseInt(sPorc.getText().toString());

        if (!nome.getText().toString().equals("") && !ra.getText().toString().equals("") && ((!sPorc.getText().toString().equals(""))
                && (!(porc >100)) && (!(porc<0))) && ((!sMedia.getText().toString().equals("") && (!(media<0)) && (!(media>10)) ))){
            c.setCursonome(nome.getText().toString());
            c.setRa(Integer.parseInt(ra.getText().toString()));
            c.setInstituicao(instituicao.getText().toString());
            c.setTurno(ad1.getItem(sTurno.getSelectedItemPosition()));
            c.setSemestre(Integer.parseInt(ad3.getItem(sSemestre.getSelectedItemPosition())));
            c.setPorcaprovacao(porc);
            c.setMediaaprov(media);
            boolean isUpdate = cDAO.updateCurso(c);
            System.out.println(isUpdate);

            if (isUpdate == true) {
                Toast.makeText(CursoView.this, "Alterado com sucesso!", Toast.LENGTH_SHORT).show();
                finish();
            } else {
                Toast.makeText(CursoView.this, "Não alterado!", Toast.LENGTH_SHORT).show();
            }
        } else {
            Toast.makeText(CursoView.this, "Insira os Campos Obrigatórios!", Toast.LENGTH_SHORT).show();
            if (nome.getText().toString().equals(""))
                nome.setError("Campo Obrigatório");
            if (ra.getText().toString().equals(""))
                ra.setError("Campo Obrigatório");

            if (sPorc.getText().toString().equals(""))
                sPorc.setError("Campo Obrigatório");
            if((porc>100) || (porc<0))
                sPorc.setError("A porcentagem de aprovação deve ser de 0 a 100%");

            if (sMedia.getText().toString().equals(""))
                sMedia.setError("Campo Obrigatório");
            if((media>100) || (media<0))
                sMedia.setError("A média de aprovação deve ser de 0 a 10");
        }
    }

    @Override
    public boolean onSupportNavigateUp(){
        finish();
        return true;
    }
}
