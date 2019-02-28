package com.example.agnaldoburgojunior.myclassv1.Adapter;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.agnaldoburgojunior.myclassv1.Models.Tarefa;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.List;

/**
 * Created by Andressa on 28/04/2016.
 */
public class TarefaAdapter extends RecyclerView.Adapter<TarefaAdapter.MyViewHolder1> {

    private List<Tarefa> mList;
    private LayoutInflater mLayoutInflater;
    private RecyclerViewOnClickListenerHack mRecyclerViewOnClickListenerHack;

    public TarefaAdapter(Context c, List<Tarefa> l) {
        mList = l;
        mLayoutInflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public MyViewHolder1 onCreateViewHolder(ViewGroup parent, int viewType) {

        View v = mLayoutInflater.inflate(R.layout.item_lista3, parent, false);
        MyViewHolder1 mvh = new MyViewHolder1(v);

        return mvh;
    }

    @Override
    public void onBindViewHolder(MyViewHolder1 holder, int position) {

        holder.nome.setText(mList.get(position).getNome());
        holder.tipo.setText(mList.get(position).getTipoTarefa(mList.get(position).getCodtipotarefa()));
        holder.disc.setText(mList.get(position).getNomeDisciplina(mList.get(position).getCoddisciplina()));
        holder.status.setVisibility(mList.get(position).getStatus());

    }

    @Override
    public int getItemCount() {
        return mList.size();
    }

    public void setRecyclerViewOnClickListenerHack(RecyclerViewOnClickListenerHack r) {
        mRecyclerViewOnClickListenerHack = r;
    }

    public void addListItem(Tarefa tarefa, int position) {
        mList.add(tarefa);
        notifyItemInserted(position);
        guardaCodigo(tarefa.getCodtarefa(), position);
    }

    public int guardaCodigo(int codigo, int position){
        return codigo;
    }

    public class MyViewHolder1 extends RecyclerView.ViewHolder implements View.OnClickListener {

        public TextView nome,tipo,disc;
               TextView status;
        public MyViewHolder1(View itemView) {
            super(itemView);

            nome = (TextView) itemView.findViewById(R.id.adp_txt1);
            tipo = (TextView) itemView.findViewById(R.id.adp_txt2);
            disc = (TextView) itemView.findViewById(R.id.adp_txt3);
            status = (TextView) itemView.findViewById(R.id.status_icon);
            itemView.setOnClickListener(this);
        }

        @Override
        public void onClick(View v) {
            if (mRecyclerViewOnClickListenerHack != null) {
                mRecyclerViewOnClickListenerHack.onClickListener(v, getPosition());
            }
        }
    }
}