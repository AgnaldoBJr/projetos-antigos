package com.example.agnaldo.retrofitproject2crud;

import android.content.Context;
import android.content.Intent;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import com.example.agnaldo.retrofitproject2crud.models.Tarefa;

import java.util.List;

public class MyAdapter extends ArrayAdapter<Tarefa> {

    private Context context;
    private List<Tarefa> lista;

    public MyAdapter(@NonNull Context context, int resource, @NonNull List<Tarefa> objects) {
        super(context, resource, objects);

        this.context = context;
        this.lista = objects;
    }

    @NonNull
    @Override
    public View getView(final int position, @Nullable View convertView, @NonNull ViewGroup parent) {

        LayoutInflater layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View rowView = layoutInflater.inflate(R.layout.item_list, parent, false);

        TextView tId = (TextView) rowView.findViewById(R.id.id);
        TextView tDescricao = (TextView) rowView.findViewById((R.id.descricao));
        TextView tData = (TextView) rowView.findViewById(R.id.data_cad);

        tId.setText(String.valueOf(lista.get(position).getId()));
        tDescricao.setText(lista.get(position).getDescricao());
        tData.setText(lista.get(position).getData_cad());

        rowView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(context, TarefaActivity.class);
                i.putExtra("tarefa_descricao", lista.get(position).getDescricao());
                i.putExtra("tarefa_data", lista.get(position).getData_cad());
                i.putExtra("tarefa_id", String.valueOf(lista.get(position).getId()));
                context.startActivity(i);
            }
        });
        return rowView;
    }
}
