package com.example.agnaldo.retrofitproject2crud;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;

import com.example.agnaldo.retrofitproject2crud.models.Tarefa;
import com.example.agnaldo.retrofitproject2crud.services.ApiUtils;
import com.example.agnaldo.retrofitproject2crud.services.TarefaService;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


//Referencia: https://www.jackrutorial.com/2018/06/retrofit-2-crud-android-example.html
public class MainActivity extends AppCompatActivity {

    Button adicionar, listar;
    TextView empty;
    ListView listView;

    TarefaService tarefaService;
    List<Tarefa> listaTarefas = new ArrayList<Tarefa>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        setTitle("Retrofit - Tarefas");

        adicionar = (Button) findViewById(R.id.add_tarefa);
        listar = (Button) findViewById(R.id.list_tarefa);
        empty = (TextView) findViewById(R.id.empty);
        listView = (ListView) findViewById(R.id.list_view);

        listView.setEmptyView(empty);

        tarefaService = ApiUtils.getTarefaService();

        adicionar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(MainActivity.this, TarefaActivity.class);
                i.putExtra("tarefa_descricao", "");
                startActivity(i);
            }
        });

        listar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getTarefasList();
            }
        });
    }

    public void getTarefasList(){
        Call<List<Tarefa>> requestTarefas = tarefaService.getTarefas();
        requestTarefas.enqueue(new Callback<List<Tarefa>>() {
            @Override
            public void onResponse(Call<List<Tarefa>> call, Response<List<Tarefa>> response) {
                if(response.isSuccessful()){
                    Log.i("OK: ", String.valueOf(response.code()));
                    listaTarefas = response.body();
                    for(Tarefa tar : listaTarefas){
                        System.out.println(tar.getDescricao() + "------------");
                    }


                    listView.setAdapter(new MyAdapter(MainActivity.this, R.layout.item_list, listaTarefas));
                }
            }

            @Override
            public void onFailure(Call<List<Tarefa>> call, Throwable t) {
                Log.e("ERROR: ", t.getMessage());
            }
        });


    }
}
