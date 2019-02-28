package com.example.agnaldoburgojunior.myclassv1.Adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.agnaldoburgojunior.myclassv1.Components.NavItem;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.List;

/**
 * Created by Agnaldo.Burgo.Junior on 25/03/2016.
 */
public class AdapterSlidingMenuList extends ArrayAdapter<NavItem> {

        Context context;
        int resLayout;
        List<NavItem> listNavItens;

    public AdapterSlidingMenuList(Context context, int resLayout, List<NavItem> listNavItens) {
        super(context, resLayout, listNavItens);

        this.context = context;
        this.resLayout = resLayout;
        this.listNavItens = listNavItens;
    }


    @SuppressLint("ViewHolder") @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            View v = View.inflate(context, resLayout, null);

            TextView tvTitle = (TextView) v.findViewById(R.id.title);
            ImageView navIcon = (ImageView) v.findViewById(R.id.icon_nav);

            NavItem navItem = listNavItens.get(position);
            tvTitle.setText(navItem.getTitle());
            navIcon.setImageResource(navItem.getIcon());

            return v;
        }
    }

