package com.example.agnaldoburgojunior.myclassv1.Adapter;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.agnaldoburgojunior.myclassv1.Models.TipoDeTarefa;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.List;

/**
 * Created by Andressa on 28/04/2016.
 */
public class TipoTarAdapter extends RecyclerView.Adapter<TipoTarAdapter.MyViewHolder1>  {
    private List<TipoDeTarefa> mList;
    private LayoutInflater mLayoutInflater;
    private RecyclerViewOnClickListenerHack mRecyclerViewOnClickListenerHack;

    public TipoTarAdapter(Context c, List<TipoDeTarefa> l) {
        mList = l;
        mLayoutInflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public MyViewHolder1 onCreateViewHolder(ViewGroup parent, int viewType) {

        View v = mLayoutInflater.inflate(R.layout.item_lista1, parent, false);
        MyViewHolder1 mvh = new MyViewHolder1(v);

        return mvh;
    }

    @Override
    public void onBindViewHolder(MyViewHolder1 holder, int position) {

        holder.tTipoTar.setText(mList.get(position).getTiponome());

    }

    @Override
    public int getItemCount() {
        return mList.size();
    }

    public void setRecyclerViewOnClickListenerHack(RecyclerViewOnClickListenerHack r) {
        mRecyclerViewOnClickListenerHack = r;
    }

    public void addListItem(TipoDeTarefa tipotarefa, int position) {
        mList.add(tipotarefa);
        notifyItemInserted(position);
        guardaCodigo(tipotarefa.getCodtipodetarefa(), position);
    }

    public int guardaCodigo(int codigo, int position){
        return codigo;
    }

    public class MyViewHolder1 extends RecyclerView.ViewHolder implements View.OnClickListener {

        public TextView tTipoTar;

        public MyViewHolder1(View itemView) {
            super(itemView);

            tTipoTar = (TextView) itemView.findViewById(R.id.adp_txt);

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
