package com.example.agnaldoburgojunior.myclassv1.Teste;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoReferenciaDAO;
import com.example.agnaldoburgojunior.myclassv1.Models.TipoReferencia;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.List;

public class TesteSpinner extends AppCompatActivity {

    Spinner spinner;
    Button excluir;
    Button alterar;
    ArrayAdapter<TipoReferencia> arrayAdapter;
    EditText e;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_teste_spinner);

        spinner = (Spinner) findViewById(R.id.spinnerTipoReferencia);
        e = (EditText) findViewById(R.id.ed);
        excluir = (Button) findViewById(R.id.excluir);
        alterar = (Button) findViewById(R.id.alterar);

        TipoReferenciaDAO t = new TipoReferenciaDAO();
        List<TipoReferencia> l = t.selectTodosTipoReferencia();

        arrayAdapter  = new ArrayAdapter<TipoReferencia>(this, android.R.layout.simple_spinner_dropdown_item, l);
        arrayAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        spinner.setAdapter(arrayAdapter);

        excluir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String codigo = arrayAdapter.getItem(spinner.getSelectedItemPosition()).getCodTipo().toString();
                TipoReferenciaDAO t = new TipoReferenciaDAO();
                int i = t.deleteTipoReferencia(codigo);

                if (i == 1) {
                    Toast.makeText(TesteSpinner.this, "Excluído com sucesso!", Toast.LENGTH_LONG).show();
                    finish();
                } else {
                    Toast.makeText(TesteSpinner.this, "Não excluído!", Toast.LENGTH_LONG).show();
                }

            }
        });

        alterar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                TipoReferencia t = new TipoReferencia();
                t = arrayAdapter.getItem(spinner.getSelectedItemPosition());
                t.setNome(e.getText().toString());

                TipoReferenciaDAO tDAO = new TipoReferenciaDAO();
                boolean a = tDAO.updateTipoReferencia(t);

                if (a == true) {
                    Toast.makeText(TesteSpinner.this, "Alterado com sucesso!", Toast.LENGTH_LONG).show();
                    finish();
                } else {
                    Toast.makeText(TesteSpinner.this, "Não alterado!", Toast.LENGTH_LONG).show();
                }
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_teste_spinner, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();


        return super.onOptionsItemSelected(item);
    }
}
