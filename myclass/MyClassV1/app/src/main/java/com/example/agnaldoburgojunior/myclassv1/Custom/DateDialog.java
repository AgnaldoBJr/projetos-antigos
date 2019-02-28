package com.example.agnaldoburgojunior.myclassv1.Custom;

import android.app.DatePickerDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.os.Bundle;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;

import java.util.Calendar;

/**
 * Created by Andressa on 06/04/2016.
 */
public class DateDialog extends DialogFragment implements DatePickerDialog.OnDateSetListener{

    static String dia, mes, ano;

    EditText txtdate;
    public DateDialog(View view){
        txtdate=(EditText)view;
    }

    public DateDialog() {
    }

    public Dialog onCreateDialog(Bundle savedInstanceState) {


// Use the current date as the default date in the dialog
        final Calendar c = Calendar.getInstance();
        int year = c.get(Calendar.YEAR);
        int month = c.get(Calendar.MONTH);
        int day = c.get(Calendar.DAY_OF_MONTH);
        // Create a new instance of DatePickerDialog and return it
        return new DatePickerDialog(getActivity(), this, year, month, day);


    }

        public void onDateSet(DatePicker view, int year, int month, int day) {
        //show to the selected date in the text box
            if(day <10)
                dia ="0"+ String.valueOf(day);
            else
                dia = String.valueOf(day);

            if(month <10)
                mes = "0" + String.valueOf(month+1);
            else
                mes= String.valueOf(month+1);

            String date =dia + "-" + mes + "-" + year;
        txtdate.setText(date);
    }

}

