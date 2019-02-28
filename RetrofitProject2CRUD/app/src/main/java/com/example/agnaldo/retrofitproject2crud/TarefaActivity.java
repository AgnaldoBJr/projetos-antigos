package com.example.agnaldo.retrofitproject2crud;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.example.agnaldo.retrofitproject2crud.models.Tarefa;
import com.example.agnaldo.retrofitproject2crud.services.ApiUtils;
import com.example.agnaldo.retrofitproject2crud.services.TarefaService;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TarefaActivity extends AppCompatActivity {

    TextView codigo;
    EditText descricao;
    EditText data;
    Button salvar;
    Button deletar;

    TarefaService tarefaService;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tarefa);

        setTitle("Tarefas");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        codigo = (TextView) findViewById(R.id.tarefa_codigo);
        descricao = (EditText) findViewById(R.id.tarefa_descricao);
        data = (EditText) findViewById(R.id.tarefa_data);
        salvar = (Button) findViewById(R.id.btn_salvar);
        deletar = (Button) findViewById(R.id.btn_excluir);

        tarefaService = ApiUtils.getTarefaService();

        Bundle extras = getIntent().getExtras();
        final String tarefaId = extras.getString("tarefa_id");
        String tarefaDescricao = extras.getString("tarefa_descricao");
        String tarefaData = extras.getString("tarefa_data");

        codigo.setText(tarefaId);
        descricao.setText(tarefaDescricao);
        data.setText(tarefaData);

        if(tarefaId != null && tarefaId.trim().length() > 0){

        } else {
            deletar.setVisibility(View.INVISIBLE);
            codigo.setVisibility(View.INVISIBLE);
        }

        salvar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Tarefa t = new Tarefa(descricao.getText().toString(), data.getText().toString());

                if(tarefaId != null && tarefaId.trim().length() > 0){
                    //Atualiza a tarefa

                    updateTarefa(Integer.parseInt(tarefaId), t);

                } else {
                    //Cria uma nova tarefa
                    addTarefa(t);
                }
                Intent intent = new Intent(TarefaActivity.this, MainActivity.class).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);
            }
        });

        deletar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                deleteTarefa(Integer.parseInt(tarefaId));

                Intent intent = new Intent(TarefaActivity.this, MainActivity.class).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);
            }
        });
    }

    public void updateTarefa(int id, Tarefa tarefa){
        Call<Tarefa> requestTarefa = tarefaService.updateTarefa(id, tarefa);
        requestTarefa.enqueue(new Callback<Tarefa>() {
            @Override
            public void onResponse(Call<Tarefa> call, Response<Tarefa> response) {
                if(response.isSuccessful()){
                    Toast.makeText(getApplicationContext(), "Tarefa Atualizada com sucesso!", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<Tarefa> call, Throwable t) {
                Log.e("ERROR: ", t.getMessage());

            }
        });
        Intent intent = new Intent(TarefaActivity.this, MainActivity.class).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        startActivity(intent);
    }

    public void addTarefa(Tarefa tarefa){

        Call<Tarefa> requestTarefa = tarefaService.createTarefa(tarefa);
        requestTarefa.enqueue(new Callback<Tarefa>() {
            @Override
            public void onResponse(Call<Tarefa> call, Response<Tarefa> response) {
                if(response.isSuccessful()){
                    System.out.println(call.toString());
                    System.out.println(response.body().getDescricao());
                    System.out.println(response.body().getData_cad());
                    Toast.makeText(getApplicationContext(), "Tarefa criada com sucesso", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<Tarefa> call, Throwable t) {
                Log.e("ERROR: ", t.getMessage());

            }
        });
    }

    public void deleteTarefa(int id){
        Call<Tarefa> requestTarefa = tarefaService.deleteTarefa(id);
        requestTarefa.enqueue(new Callback<Tarefa>() {
            @Override
            public void onResponse(Call<Tarefa> call, Response<Tarefa> response) {
                if(response.isSuccessful()){
                    Toast.makeText(getApplicationContext(), "Tarefa excluida com sucesso", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<Tarefa> call, Throwable t) {
                Log.e("ERROR: ", t.getMessage());
            }
        });
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                finish();
                return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
