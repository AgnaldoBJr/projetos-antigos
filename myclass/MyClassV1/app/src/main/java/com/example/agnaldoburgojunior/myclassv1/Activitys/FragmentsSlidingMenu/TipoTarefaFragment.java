package com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.agnaldoburgojunior.myclassv1.Activitys.TipoDeTarefaView;
import com.example.agnaldoburgojunior.myclassv1.Adapter.RecyclerViewOnClickListenerHack;
import com.example.agnaldoburgojunior.myclassv1.Adapter.TipoTarAdapter;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoTarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Custom.DividerItemDecoration;
import com.example.agnaldoburgojunior.myclassv1.Models.TipoDeTarefa;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 25/03/2016.
 */
public class TipoTarefaFragment extends Fragment {


    com.github.clans.fab.FloatingActionButton novo;
    RecyclerView mRecyclerView;
    List<TipoDeTarefa> mList;


    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_tipo_tarefa, container, false);

        novo = (com.github.clans.fab.FloatingActionButton) v.findViewById(R.id.novo_tipo_tarefa);
        mRecyclerView = (RecyclerView) v.findViewById(R.id.list_tipo_tar);

        novo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getContext(), TipoDeTarefaView.class);
                Bundle b = new Bundle();
                b.putInt("cod", 0);
                i.putExtras(b);
                startActivity(i);
            }
        });

        return v;
    }

    @Override
    public void onResume() {
        super.onResume();
        
        TipoTarefaDAO t = new TipoTarefaDAO();
        mList = t.selectTodosTipoTarefa();

        mRecyclerView.setHasFixedSize(true);
        mRecyclerView.setOnScrollListener(new RecyclerView.OnScrollListener() {
            @Override
            public void onScrollStateChanged(RecyclerView recyclerView, int newState) {
                super.onScrollStateChanged(recyclerView, newState);
            }

            @Override
            public void onScrolled(RecyclerView recyclerView, int dx, int dy) {
                super.onScrolled(recyclerView, dx, dy);

                LinearLayoutManager llm = (LinearLayoutManager) mRecyclerView.getLayoutManager();
                TipoTarAdapter adp = (TipoTarAdapter) mRecyclerView.getAdapter();

                if (mList.size() == llm.findFirstCompletelyVisibleItemPosition() + 1) {
                    TipoTarefaDAO t = new TipoTarefaDAO();

                    List<TipoDeTarefa> listAux = t.selectTodosTipoTarefa();


                    for (int i = 0; i < listAux.size(); i++) {
                        adp.addListItem(listAux.get(i), mList.size());
                    }
                }
            }
        });

        LinearLayoutManager llm = new LinearLayoutManager(getContext());
        llm.setOrientation(LinearLayoutManager.VERTICAL);
        mRecyclerView.setLayoutManager(llm);

        mList = t.selectTodosTipoTarefa();
        TipoTarAdapter adp = new TipoTarAdapter(getContext(), mList);

        adp.setRecyclerViewOnClickListenerHack(new RecyclerViewOnClickListenerHack() {
            @Override
            public void onClickListener(View view, int position) {


                Intent myIntent = new Intent(getContext(), TipoDeTarefaView.class);
                Bundle b = new Bundle();
                b.putInt("cod", mList.get(position).getCodtipodetarefa());
                b.putBoolean("visibilidade", true);
                myIntent.putExtras(b);
                startActivity(myIntent);

            }
        });
        mRecyclerView.addItemDecoration(new DividerItemDecoration(getContext(), LinearLayoutManager.VERTICAL));
        mRecyclerView.setAdapter(adp);
    }

}
