package com.example.agnaldoburgojunior.myclassv1.Adapter;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoTarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Models.Referencia;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.List;

/**
 * Created by Andressa on 28/04/2016.
 */
public class ReferenciaAdapter extends RecyclerView.Adapter<ReferenciaAdapter.MyViewHolder1> {

    private List<Referencia> mList;
    private LayoutInflater mLayoutInflater;
    private RecyclerViewOnClickListenerHack mRecyclerViewOnClickListenerHack;

    public ReferenciaAdapter(Context c, List<Referencia> l) {
        mList = l;
        mLayoutInflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public MyViewHolder1 onCreateViewHolder(ViewGroup parent, int viewType) {

        View v = mLayoutInflater.inflate(R.layout.item_lista2, parent, false);
        MyViewHolder1 mvh = new MyViewHolder1(v);

        return mvh;
    }

    @Override
    public void onBindViewHolder(MyViewHolder1 holder, int position) {
        TipoTarefaDAO tr = new TipoTarefaDAO();
        holder.nome.setText(mList.get(position).getTitulo());
        holder.tipo.setText(mList.get(position).getTipoRef(mList.get(position).getCodtipo()));
        }

    @Override
    public int getItemCount() {
        return mList.size();
    }

    public void setRecyclerViewOnClickListenerHack(RecyclerViewOnClickListenerHack r) {
        mRecyclerViewOnClickListenerHack = r;
    }

    public void addListItem(Referencia referencia, int position) {
        mList.add(referencia);
        notifyItemInserted(position);
        guardaCodigo(referencia.getCodreferncias(), position);
    }

    public int guardaCodigo(int codigo, int position){
        return codigo;
    }

    public class MyViewHolder1 extends RecyclerView.ViewHolder implements View.OnClickListener {

        public TextView nome ,tipo;

        public MyViewHolder1(View itemView) {
            super(itemView);

            nome = (TextView) itemView.findViewById(R.id.adp_txt1);
            tipo = (TextView) itemView.findViewById(R.id.adp_txt2);

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
