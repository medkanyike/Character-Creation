#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>
#include <string.h>
#include <time.h>


int main(void)
{
    FILE *fp;
    FILE *fResults;
    FILE *fp1Lines, *fp2Lines, *fp3Lines, *fp4Lines, *fp5Lines, *fp6Lines, *fp7Lines, *fp8Lines;
    FILE *fp1, *fp2, *fp3, *fp4, *fp5, *fp6, *fp7, *fp8;
    char usercode[10];
    char status[20];
    char promptUsercode[10];
    char assignmentUrl[44];
    char attemptsUrl[44];
    int cont = 0;
    int ch = 0;
    FILE *fa;
    FILE *fuse;
    FILE *temp;
    char id[100];
    char startDate[100];
    char startTime[100];
    char endDate[100];
    char endTime[100];
    char a[2];
    char b[2];
    char c[2];
    char d[2];
    char e[2];
    char f[2];
    char g[2];
    char h[2];
    char *choice_character;
    int attempt;
    char filename1[15] = "./positions/";
    char filename2[15] = "./positions/";
    char filename3[15] = "./positions/";
    char filename4[15] = "./positions/";
    char filename5[15] = "./positions/";
    char filename6[15] = "./positions/";
    char filename7[15] = "./positions/";
    char filename8[15] = "./positions/";
    char emptyVal[2] = "-";
    //int ch = 0;
    char position[10];
    int activationRequest;
    FILE *ReqfpAdd, *ReqfpRead;
    char storedUsercode[10];
    time_t start_secondsM;
    time_t end_secondsM;
    int total_score = 0;
    int attemptCharacters = 0;
    ///given assignment
    int doneAssignmentId;
    float averageScore;
    int averageTime;
    ////
    ///check dates
    struct tm tmVar1;
    time_t timeVar1;

    struct tm tmVar2;
    time_t timeVar2;
    struct tm tmVar3;
    time_t timeVar3;
    int check;
    time_t expire_line = time(NULL);

    // fetch and compare all the stored usercodes
    do
    {

        fp = fopen(".\\../textfiles/pupils.txt", "r");

        printf("Please enter your usercode\n");
        scanf("%s", promptUsercode);
        while (fscanf(fp, "%s %s %s %s", usercode, status, assignmentUrl, attemptsUrl) > 0)
        {

            //start comparing the usercodes
            if (strcmp(usercode, promptUsercode) == 0)
            {

                int alreadyRequested = 0;
                //check if the user had already submitted their request
                if (strcmp(status, "activated") == 1)
                {
                    ///Reqesut for activatation
                    printf("You are currently deactivated\n");
                    printf("Enter:\n1.For activation\n.0 to exit\n");
                    scanf("%d", &activationRequest);
                    if (activationRequest == 1)
                    {
                        //add the usercode the request file list
                        ReqfpRead = fopen("./activation/requests.txt", "r");
                        ///the request was sent already
                        while (fscanf(ReqfpRead, "%s", storedUsercode) > 0)
                        {

                            if (strcmp(usercode, storedUsercode) == 0)
                            {
                                alreadyRequested = 1;
                            }
                        }
                        if (alreadyRequested == 1)
                        {
                            printf("Previously your request was sent successfully\n");
                            printf("Try again within the next 24hours\n");
                            printf("Thanks management\n");
                            fclose(ReqfpRead);
                        }
                        else
                        {
                            ReqfpAdd = fopen("./activation/requests.txt", "a+");
                            strncat(usercode, "\n", 2);
                            fprintf(ReqfpAdd, usercode);
                            printf(".......activation request sent successfully\n");
                            printf("Try again within 24hours when the teacher has activated you\n");
                            printf("Thanks management\n");

                            fclose(ReqfpAdd);
                        }
                        cont = 1;
                    }
                    else
                    {
                        //check status
                        cont = 1;
                        break;
                    }
                }
                else
                {
                    do
                    {
                        ///start the timer for the whole assignment
                        start_secondsM = time(NULL);
                        printf("\n.1:Attempt Assignment And View Details");
                        printf("\n.2:Check status");
                        printf("\n.3:Check assignments between dates");
                        printf("\n.0:Exit\n");

                        scanf("%d", &ch);
                        switch (ch)
                        {
                        case 1:
                            ///store the pupil result

                            ///
                            fa = fopen(assignmentUrl, "r");
                            
                            //printf("%s", filename);
                            ///display available assignments
                            //print firstname and lastname
                            while (fscanf(fa, "%s %s %s %s %s %s %s %s %s %s %s %s %s", id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h) > 0)
                            {
                                //printf("id:%s\n", id);

                                printf("id:%s startDate: %s  startTime: %s endtDate: %s  endTime: %s  %s %s %s %s %s %s %s %s\n", &id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h);
                            }
                            fclose(fa);

                            fuse = fopen(assignmentUrl, "r");
                            temp = fopen(".\\../textfiles/assignments/temp.txt", "w");
                            printf("Choose the assignment to attempt by id \t Details will be displayed respectively\n");
                            scanf("%d", &attempt);
                            int counter; //tracking the line to delete
                            while (fscanf(fuse, "%s %s %s %s %s %s %s %s %s %s %s %s %s", id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h) > 0)
                            {

                                if (atoi(id) == attempt)
                                {
                                    printf("\nyou chose\n");

                                    printf(" id:%s\n  startDate:%s\n  startTime:%s\n  endtDate:%s\n  endTime:%s\n  ch1:%s\n  ch2:%s\n  ch3:%s\n  ch4:%s\n  ch5:%s\n  ch6:%s\n  ch7:%s\n  ch8:%s\n", id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h);

                                    doneAssignmentId = atoi(id);
                                    for (int i = 97; i < 105; i++)
                                    {

                                        char character = i;
                                        //our prefined character variables
                                        switch (character)
                                        {
                                        case 'a':
                                            if (strcmp(a, emptyVal) == 1)
                                            {

                                                char position1[10];
                                                int correctPosition1s = 0;
                                                time_t start_seconds1;
                                                time_t end_seconds1;
                                                int input1;
                                                int counter1 = 0; //helps us know the  position from 0-25
                                                int enteredMatrix1[5][5] = {0};
                                                char scounter1[10];
                                                int score1 = 0;
                                                start_seconds1 = time(NULL);
                                                //Find the number of correct positions depending on the stored positions in the text file

                                                printf("Attempt starting within a second... .....Incase of too much delay start the application again");
                                                printf("\n\n\nInstructions:Enter either 0 or 1 \n  1.For correct postion \n  0For Invalid postion");
                                                strncat(filename1, a, 2);
                                                strncat(filename1, ".txt", 5);
                                                printf("\n  Attempting %s\n", a);
                                                fp1Lines = fopen(filename1, "r");
                                                while (fscanf(fp1Lines, "%s\n", position1) > 0)
                                                {
                                                    correctPosition1s++;
                                                }
                                                //printf("total number is %d", correctPosition1s);
                                                fclose(fp1Lines);
                                                //attempting the character assignment
                                                for (int col = 0; col < 5; col++)
                                                {
                                                    for (int row = 0; row < 5; row++)
                                                    {
                                                        fp1 = fopen(filename1, "r"); //open the text file containing the right answers
                                                        printf("\n  %s[%d][%d]:\n", a, col, row);
                                                        ///enter the input and compare
                                                        //open and close the file for each comparison
                                                        //only open the file after the user has entered 1 and 0 to ignore openning the file
                                                        scanf("  %d\n", &input1);
                                                        //printf("%d",input1);
                                                        //store the user input for later display
                                                        enteredMatrix1[col][row] = input1;
                                                        if (input1 == 1)
                                                        {
                                                            //compare now and award a mark
                                                            do
                                                            {
                                                                ///convert the counter to  astring
                                                                itoa(counter1, scounter1, 10);
                                                                //open the file for each input of 1
                                                                while (fscanf(fp1, "%s", position1) > 0)
                                                                {
                                                                    if (strcmp(position1, scounter1) == 0)
                                                                    {
                                                                        score1++;
                                                                        printf("Score so far: %d", score1);
                                                                        //printf("Current score is %s,%s",scounter,position);
                                                                    }
                                                                }

                                                            } while (!feof(fp1));
                                                            printf("\n");
                                                            fclose(fp1); //close the file and open it for each line
                                                            counter1++;
                                                        }
                                                    }
                                                }
                                                printf("This is the your output\n");
                                                for (int x = 0; x < 5; x++)
                                                {
                                                    for (int y = 0; y < 5; y++)
                                                    {
                                                        if (enteredMatrix1[x][y] == 1)
                                                        {
                                                            printf("*");
                                                        }
                                                        else if (enteredMatrix1[x][y] == 0)
                                                        {
                                                            printf(" ");
                                                        }
                                                    }
                                                    printf("\n");
                                                }

                                                end_seconds1 = time(NULL);
                                                //increment the total score
                                                total_score = total_score + (100 * (float)score1 / correctPosition1s);
                                                attemptCharacters++;
                                                printf("Your total score in %s is %d", a, score1);
                                                printf("\n Percentage score %.2f", 100 * (float)score1 / correctPosition1s);
                                                printf("\nThe character took you %ld  seconds to complete", (end_seconds1 - start_seconds1));
                                                printf("\nPossible correct positions %d", correctPosition1s);

                                                //end of attempting a particular assignment;
                                                fflush(stdin);
                                                fflush(stdout);
                                                continue;
                                            }
                                        case 'b':
                                            if (strcmp(b, emptyVal) == 1)
                                            {

                                                char position2[10];
                                                int correctPosition2s = 0;
                                                time_t start_seconds2;
                                                time_t end_seconds2;
                                                int input2;
                                                int counter2 = 0; //helps us know the  position from 0-25
                                                int enteredMatrix2[5][5] = {0};
                                                char scounter2[10];
                                                int score2 = 0;
                                                start_seconds2 = time(NULL);
                                                //Find the number of correct positions depending on the stored positions in the text file

                                                //printf("Instructions:Enter either 0 or 1 \n1.For correct postion \n0.For Invalid postion");
                                                strncat(filename2, b, 2);
                                                strncat(filename2, ".txt", 5);
                                                printf("\nAttempting %s\n", b);
                                                fp2Lines = fopen(filename2, "r");
                                                while (fscanf(fp2Lines, "%s\n", position2) > 0)
                                                {
                                                    correctPosition2s++;
                                                }
                                                fclose(fp2Lines);
                                                //attempting the character assignment
                                                for (int col = 0; col < 5; col++)
                                                {
                                                    for (int row = 0; row < 5; row++)
                                                    {
                                                        fp2 = fopen(filename2, "r"); //open the text file containing the right answers
                                                        printf("\n%s[%d][%d]:\n", b, col, row);
                                                        ///enter the input and compare
                                                        //open and close the file for each comparison
                                                        //only open the file after the user has entered 1 and 0 to ignore openning the file
                                                        scanf("%d\n", &input2);
                                                        //printf("%d",input1);
                                                        //store the user input for later display
                                                        enteredMatrix2[col][row] = input2;
                                                        if (input2 == 1)
                                                        {
                                                            //compare now and award a mark
                                                            do
                                                            {
                                                                ///convert the counter to  astring
                                                                itoa(counter2, scounter2, 10);
                                                                //open the file for each input of 1
                                                                while (fscanf(fp2, "%s", position2) > 0)
                                                                {
                                                                    if (strcmp(position2, scounter2) == 0)
                                                                    {
                                                                        score2++;
                                                                        printf("Score so far: %d", score2);
                                                                        //printf("Current score is %s,%s",scounter,position);
                                                                    }
                                                                }

                                                            } while (!feof(fp2));
                                                            printf("\n");
                                                            fclose(fp2); //close the file and open it for each line
                                                            counter2++;
                                                        }
                                                    }
                                                }
                                                printf("This is the your output\n");
                                                for (int x = 0; x < 5; x++)
                                                {
                                                    for (int y = 0; y < 5; y++)
                                                    {
                                                        if (enteredMatrix2[x][y] == 1)
                                                        {
                                                            printf("*");
                                                        }
                                                        else if (enteredMatrix2[x][y] == 0)
                                                        {
                                                            printf(" ");
                                                        }
                                                    }
                                                    printf("\n");
                                                }

                                                end_seconds2 = time(NULL);
                                                //increment the total score
                                                total_score = total_score + (100 * (float)score2 / correctPosition2s);
                                                attemptCharacters++;

                                                printf("Your total score in %s is %d", a, score2);
                                                printf("\n Percentage score %.2f", 100 * (float)score2 / correctPosition2s);
                                                printf("\nThe character took you %ld  seconds to complete", (end_seconds2 - start_seconds2));
                                                printf("\nPossible correct positions %d", correctPosition2s);

                                                fflush(stdin);
                                                fflush(stdout);
                                                continue;
                                            }
                                        case 'c':
                                            if (strcmp(c, emptyVal) == 1)
                                            {
                                                char position3[10];
                                                int correctPosition3s = 0;
                                                time_t start_seconds3;
                                                time_t end_seconds3;
                                                int input3;
                                                int counter3 = 0; //helps us know the  position from 0-25
                                                int enteredMatrix3[5][5] = {0};
                                                char scounter3[10];
                                                int score3 = 0;
                                                start_seconds3 = time(NULL);
                                                //Find the number of correct positions depending on the stored positions in the text file

                                                //printf("Instructions:Enter either 0 or 1 \n1.For correct postion \n0.For Invalid postion");
                                                strncat(filename3, c, 2);
                                                strncat(filename3, ".txt", 5);
                                                printf("\nAttempting %s\n", c);
                                                fp3Lines = fopen(filename3, "r");
                                                while (fscanf(fp3Lines, "%s\n", position3) > 0)
                                                {
                                                    correctPosition3s++;
                                                }
                                                fclose(fp3Lines);
                                                //attempting the character assignment
                                                for (int col = 0; col < 5; col++)
                                                {
                                                    for (int row = 0; row < 5; row++)
                                                    {
                                                        fp3 = fopen(filename3, "r"); //open the text file containing the right answers
                                                        printf("\n%s[%d][%d]:\n", c, col, row);
                                                        ///enter the input and compare
                                                        //open and close the file for each comparison
                                                        //only open the file after the user has entered 1 and 0 to ignore openning the file
                                                        scanf("%d\n", &input3);
                                                        //printf("%d",input1);
                                                        //store the user input for later display
                                                        enteredMatrix3[col][row] = input3;
                                                        if (input3 == 1)
                                                        {
                                                            //compare now and award a mark
                                                            do
                                                            {
                                                                ///convert the counter to  astring
                                                                itoa(counter3, scounter3, 10);
                                                                //open the file for each input of 1
                                                                while (fscanf(fp3, "%s", position3) > 0)
                                                                {
                                                                    if (strcmp(position3, scounter3) == 0)
                                                                    {
                                                                        score3++;
                                                                        printf("Score so far: %d", score3);
                                                                        //printf("Current score is %s,%s",scounter,position);
                                                                    }
                                                                }

                                                            } while (!feof(fp3));
                                                            printf("\n");
                                                            fclose(fp3); //close the file and open it for each line
                                                            counter3++;
                                                        }
                                                    }
                                                }
                                                printf("This is the your output\n");
                                                for (int x = 0; x < 5; x++)
                                                {
                                                    for (int y = 0; y < 5; y++)
                                                    {
                                                        if (enteredMatrix3[x][y] == 1)
                                                        {
                                                            printf("*");
                                                        }
                                                        else if (enteredMatrix3[x][y] == 0)
                                                        {
                                                            printf(" ");
                                                        }
                                                    }
                                                    printf("\n");
                                                }

                                                end_seconds3 = time(NULL);
                                                //increment the total score
                                                total_score = total_score + (100 * (float)score3 / correctPosition3s);
                                                attemptCharacters++;

                                                printf("Your total score in %s is %d", c, score3);
                                                printf("\n Percentage score %.2f", 100 * (float)score3 / correctPosition3s);
                                                printf("\nThe character took you %ld  seconds to complete", (end_seconds3 - start_seconds3));
                                                printf("\nPossible correct positions %d", correctPosition3s);
                                                fflush(stdin);
                                                fflush(stdout);
                                                continue;
                                            }
                                        case 'd':
                                            if (strcmp(d, emptyVal) == 1)
                                            {
                                                char position4[10];
                                                int correctPosition4s = 0;
                                                time_t start_seconds4;
                                                time_t end_seconds4;
                                                int input4;
                                                int counter4 = 0; //helps us know the  position from 0-25
                                                int enteredMatrix4[5][5] = {0};
                                                char scounter4[10];
                                                int score4 = 0;
                                                start_seconds4 = time(NULL);
                                                //Find the number of correct positions depending on the stored positions in the text file

                                                //printf("Instructions:Enter either 0 or 1 \n1.For correct postion \n0.For Invalid postion");
                                                strncat(filename4, d, 2);
                                                strncat(filename4, ".txt", 5);
                                                printf("\nAttempting %s\n", d);
                                                fp4Lines = fopen(filename4, "r");
                                                while (fscanf(fp4Lines, "%s\n", position4) > 0)
                                                {
                                                    correctPosition4s++;
                                                }
                                                fclose(fp4Lines);
                                                //attempting the character assignment
                                                for (int col = 0; col < 5; col++)
                                                {
                                                    for (int row = 0; row < 5; row++)
                                                    {
                                                        fp4 = fopen(filename4, "r"); //open the text file containing the right answers
                                                        printf("\n%s[%d][%d]:\n", d, col, row);
                                                        ///enter the input and compare
                                                        //open and close the file for each comparison
                                                        //only open the file after the user has entered 1 and 0 to ignore openning the file
                                                        scanf("%d\n", &input4);
                                                        //printf("%d",input1);
                                                        //store the user input for later display
                                                        enteredMatrix4[col][row] = input4;
                                                        if (input4 == 1)
                                                        {
                                                            //compare now and award a mark
                                                            do
                                                            {
                                                                ///convert the counter to  astring
                                                                itoa(counter4, scounter4, 10);
                                                                //open the file for each input of 1
                                                                while (fscanf(fp4, "%s", position4) > 0)
                                                                {
                                                                    if (strcmp(position4, scounter4) == 0)
                                                                    {
                                                                        score4++;
                                                                        printf("Score so far: %d", score4);
                                                                        //printf("Current score is %s,%s",scounter,position);
                                                                    }
                                                                }

                                                            } while (!feof(fp4));
                                                            printf("\n");
                                                            fclose(fp4); //close the file and open it for each line
                                                            counter4++;
                                                        }
                                                    }
                                                }
                                                printf("This is the your output\n");
                                                for (int x = 0; x < 5; x++)
                                                {
                                                    for (int y = 0; y < 5; y++)
                                                    {
                                                        if (enteredMatrix4[x][y] == 1)
                                                        {
                                                            printf("*");
                                                        }
                                                        else if (enteredMatrix4[x][y] == 0)
                                                        {
                                                            printf(" ");
                                                        }
                                                    }
                                                    printf("\n");
                                                }

                                                end_seconds4 = time(NULL);
                                                //increment the total score
                                                total_score = total_score + (100 * (float)score4 / correctPosition4s);
                                                attemptCharacters++;

                                                printf("Your total score in %s is %d", d, score4);
                                                printf("\n Percentage score %.2f", 100 * (float)score4 / correctPosition4s);
                                                printf("\nThe character took you %ld  seconds to complete", (end_seconds4 - start_seconds4));
                                                printf("\nPossible correct positions %d", correctPosition4s);
                                                fflush(stdin);
                                                fflush(stdout);
                                                continue;
                                            }
                                        case 'e':
                                            if (strcmp(e, emptyVal) == 1)
                                            {
                                                char position5[10];
                                                int correctPosition5s = 0;
                                                time_t start_seconds5;
                                                time_t end_seconds5;
                                                int input5;
                                                int counter5 = 0; //helps us know the  position from 0-25
                                                int enteredMatrix5[5][5] = {0};
                                                char scounter5[10];
                                                int score5 = 0;
                                                start_seconds5 = time(NULL);
                                                //Find the number of correct positions depending on the stored positions in the text file

                                                //printf("Instructions:Enter either 0 or 1 \n1.For correct postion \n0.For Invalid postion");
                                                strncat(filename5, e, 2);
                                                strncat(filename5, ".txt", 5);
                                                printf("\nAttempting %s\n", e);
                                                fp5Lines = fopen(filename5, "r");
                                                while (fscanf(fp5Lines, "%s\n", position5) > 0)
                                                {
                                                    correctPosition5s++;
                                                }
                                                fclose(fp5Lines);
                                                //attempting the character assignment
                                                for (int col = 0; col < 5; col++)
                                                {
                                                    for (int row = 0; row < 5; row++)
                                                    {
                                                        fp5 = fopen(filename5, "r"); //open the text file containing the right answers
                                                        printf("\n%s[%d][%d]:\n", e, col, row);
                                                        ///enter the input and compare
                                                        //open and close the file for each comparison
                                                        //only open the file after the user has entered 1 and 0 to ignore openning the file
                                                        scanf("%d\n", &input5);
                                                        //printf("%d",input1);
                                                        //store the user input for later display
                                                        enteredMatrix5[col][row] = input5;
                                                        if (input5 == 1)
                                                        {
                                                            //compare now and award a mark
                                                            do
                                                            {
                                                                ///convert the counter to  astring
                                                                itoa(counter5, scounter5, 10);
                                                                //open the file for each input of 1
                                                                while (fscanf(fp5, "%s", position5) > 0)
                                                                {
                                                                    if (strcmp(position5, scounter5) == 0)
                                                                    {
                                                                        score5++;
                                                                        printf("Score so far: %d", score5);
                                                                        //printf("Current score is %s,%s",scounter,position);
                                                                    }
                                                                }

                                                            } while (!feof(fp5));
                                                            printf("\n");
                                                            fclose(fp5); //close the file and open it for each line
                                                            counter5++;
                                                        }
                                                    }
                                                }
                                                printf("This is the your output\n");
                                                for (int x = 0; x < 5; x++)
                                                {
                                                    for (int y = 0; y < 5; y++)
                                                    {
                                                        if (enteredMatrix5[x][y] == 1)
                                                        {
                                                            printf("*");
                                                        }
                                                        else if (enteredMatrix5[x][y] == 0)
                                                        {
                                                            printf(" ");
                                                        }
                                                    }
                                                    printf("\n");
                                                }

                                                end_seconds5 = time(NULL);
                                                //increment the total score
                                                total_score = total_score + (100 * (float)score5 / correctPosition5s);
                                                attemptCharacters++;

                                                printf("Your total score in %s is %d", e, score5);
                                                printf("\n Percentage score %.2f", 100 * (float)score5 / correctPosition5s);
                                                printf("\nThe character took you %ld  seconds to complete", (end_seconds5 - start_seconds5));
                                                printf("\nPossible correct positions %d", correctPosition5s);
                                                fflush(stdin);
                                                fflush(stdout);
                                                continue;
                                            }
                                        case 'f':
                                            if (strcmp(f, emptyVal) == 1)
                                            {
                                                char position6[10];
                                                int correctPosition6s = 0;
                                                time_t start_seconds6;
                                                time_t end_seconds6;
                                                int input6;
                                                int counter6 = 0; //helps us know the  position from 0-25
                                                int enteredMatrix6[5][5] = {0};
                                                char scounter6[10];
                                                int score6 = 0;
                                                start_seconds6 = time(NULL);
                                                //Find the number of correct positions depending on the stored positions in the text file

                                                //printf("Instructions:Enter either 0 or 1 \n1.For correct postion \n0.For Invalid postion");
                                                strncat(filename6, f, 2);
                                                strncat(filename6, ".txt", 5);
                                                printf("\nAttempting %s\n", f);
                                                fp6Lines = fopen(filename6, "r");
                                                while (fscanf(fp6Lines, "%s\n", position6) > 0)
                                                {
                                                    correctPosition6s++;
                                                }
                                                fclose(fp6Lines);
                                                //attempting the character assignment
                                                for (int col = 0; col < 5; col++)
                                                {
                                                    for (int row = 0; row < 5; row++)
                                                    {
                                                        fp6 = fopen(filename6, "r"); //open the text file containing the right answers
                                                        printf("\n%s[%d][%d]:\n", f, col, row);
                                                        ///enter the input and compare
                                                        //open and close the file for each comparison
                                                        //only open the file after the user has entered 1 and 0 to ignore openning the file
                                                        scanf("%d\n", &input6);
                                                        //printf("%d",input1);
                                                        //store the user input for later display
                                                        enteredMatrix6[col][row] = input6;
                                                        if (input6 == 1)
                                                        {
                                                            //compare now and award a mark
                                                            do
                                                            {
                                                                ///convert the counter to  astring
                                                                itoa(counter6, scounter6, 10);
                                                                //open the file for each input of 1
                                                                while (fscanf(fp6, "%s", position6) > 0)
                                                                {
                                                                    if (strcmp(position6, scounter6) == 0)
                                                                    {
                                                                        score6++;
                                                                        printf("Score so far: %d", score6);
                                                                        //printf("Current score is %s,%s",scounter,position);
                                                                    }
                                                                }

                                                            } while (!feof(fp6));
                                                            printf("\n");
                                                            fclose(fp6); //close the file and open it for each line
                                                            counter6++;
                                                        }
                                                    }
                                                }
                                                printf("This is the your output\n");
                                                for (int x = 0; x < 5; x++)
                                                {
                                                    for (int y = 0; y < 5; y++)
                                                    {
                                                        if (enteredMatrix6[x][y] == 1)
                                                        {
                                                            printf("*");
                                                        }
                                                        else if (enteredMatrix6[x][y] == 0)
                                                        {
                                                            printf(" ");
                                                        }
                                                    }
                                                    printf("\n");
                                                }

                                                end_seconds6 = time(NULL);
                                                //increment the total score
                                                total_score = total_score + (100 * (float)score6 / correctPosition6s);
                                                attemptCharacters++;

                                                printf("Your total score in %s is %d", f, score6);
                                                printf("\n Percentage score %.2f", 100 * (float)score6 / correctPosition6s);
                                                printf("\nThe character took you %ld  seconds to complete", (end_seconds6 - start_seconds6));
                                                printf("\nPossible correct positions %d", correctPosition6s);
                                                fflush(stdin);
                                                fflush(stdout);
                                                continue;
                                            }
                                        case 'g':
                                            if (strcmp(g, emptyVal) == 1)
                                            {
                                                char position7[10];
                                                int correctPosition7s = 0;
                                                time_t start_seconds7;
                                                time_t end_seconds7;
                                                int input7;
                                                int counter7 = 0; //helps us know the  position from 0-25
                                                int enteredMatrix7[5][5] = {0};
                                                char scounter7[10];
                                                int score7 = 0;
                                                start_seconds7 = time(NULL);
                                                //Find the number of correct positions depending on the stored positions in the text file

                                                //printf("Instructions:Enter either 0 or 1 \n1.For correct postion \n0.For Invalid postion");
                                                strncat(filename7, g, 2);
                                                strncat(filename7, ".txt", 5);
                                                printf("\nAttempting %s\n", g);
                                                fp7Lines = fopen(filename7, "r");
                                                while (fscanf(fp7Lines, "%s\n", position7) > 0)
                                                {
                                                    correctPosition7s++;
                                                }
                                                fclose(fp7Lines);
                                                //attempting the character assignment
                                                for (int col = 0; col < 5; col++)
                                                {
                                                    for (int row = 0; row < 5; row++)
                                                    {
                                                        fp7 = fopen(filename7, "r"); //open the text file containing the right answers
                                                        printf("\n%s[%d][%d]:\n", e, col, row);
                                                        ///enter the input and compare
                                                        //open and close the file for each comparison
                                                        //only open the file after the user has entered 1 and 0 to ignore openning the file
                                                        scanf("%d\n", &input7);
                                                        //printf("%d",input1);
                                                        //store the user input for later display
                                                        enteredMatrix7[col][row] = input7;
                                                        if (input7 == 1)
                                                        {
                                                            //compare now and award a mark
                                                            do
                                                            {
                                                                ///convert the counter to  astring
                                                                itoa(counter7, scounter7, 10);
                                                                //open the file for each input of 1
                                                                while (fscanf(fp7, "%s", position7) > 0)
                                                                {
                                                                    if (strcmp(position7, scounter7) == 0)
                                                                    {
                                                                        score7++;
                                                                        printf("Score so far: %d", score7);
                                                                        //printf("Current score is %s,%s",scounter,position);
                                                                    }
                                                                }

                                                            } while (!feof(fp7));
                                                            printf("\n");
                                                            fclose(fp7); //close the file and open it for each line
                                                            counter7++;
                                                        }
                                                    }
                                                }
                                                printf("This is the your output\n");
                                                for (int x = 0; x < 5; x++)
                                                {
                                                    for (int y = 0; y < 5; y++)
                                                    {
                                                        if (enteredMatrix7[x][y] == 1)
                                                        {
                                                            printf("*");
                                                        }
                                                        else if (enteredMatrix7[x][y] == 0)
                                                        {
                                                            printf(" ");
                                                        }
                                                    }
                                                    printf("\n");
                                                }

                                                end_seconds7 = time(NULL);
                                                //increment the total score
                                                total_score = total_score + (100 * (float)score7 / correctPosition7s);
                                                attemptCharacters++;

                                                printf("Your total score in %s is %d", g, score7);
                                                printf("\n Percentage score %.2f", 100 * (float)score7 / correctPosition7s);
                                                printf("\nThe character took you %ld  seconds to complete", (end_seconds7 - start_seconds7));
                                                printf("\nPossible correct positions %d", correctPosition7s);
                                                fflush(stdin);
                                                fflush(stdout);
                                                continue;
                                            }
                                        case 'h':
                                            //if not empty
                                            if (strcmp(h, emptyVal) == 1)
                                            {
                                                char position8[10];
                                                int correctPosition8s = 0;
                                                time_t start_seconds8;
                                                time_t end_seconds8;
                                                int input8;
                                                int counter8 = 0; //helps us know the  position from 0-25
                                                int enteredMatrix8[5][5] = {0};
                                                char scounter8[10];
                                                int score8 = 0;
                                                start_seconds8 = time(NULL);
                                                //Find the number of correct positions depending on the stored positions in the text file

                                                //printf("Instructions:Enter either 0 or 1 \n1.For correct postion \n0.For Invalid postion");
                                                strncat(filename8, g, 2);
                                                strncat(filename8, ".txt", 5);
                                                printf("\nAttempting %s\n", g);
                                                fp8Lines = fopen(filename8, "r");
                                                while (fscanf(fp5Lines, "%s\n", position8) > 0)
                                                {
                                                    correctPosition8s++;
                                                }
                                                fclose(fp8Lines);
                                                //attempting the character assignment
                                                for (int col = 0; col < 5; col++)
                                                {
                                                    for (int row = 0; row < 5; row++)
                                                    {
                                                        fp8 = fopen(filename8, "r"); //open the text file containing the right answers
                                                        printf("\n%s[%d][%d]:\n", g, col, row);
                                                        ///enter the input and compare
                                                        //open and close the file for each comparison
                                                        //only open the file after the user has entered 1 and 0 to ignore openning the file
                                                        scanf("%d\n", &input8);
                                                        //printf("%d",input1);
                                                        //store the user input for later display
                                                        enteredMatrix8[col][row] = input8;
                                                        if (input8 == 1)
                                                        {
                                                            //compare now and award a mark
                                                            do
                                                            {
                                                                ///convert the counter to  astring
                                                                itoa(counter8, scounter8, 10);
                                                                //open the file for each input of 1
                                                                while (fscanf(fp8, "%s", position8) > 0)
                                                                {
                                                                    if (strcmp(position8, scounter8) == 0)
                                                                    {
                                                                        score8++;
                                                                        printf("Score so far: %d", score8);
                                                                        //printf("Current score is %s,%s",scounter,position);
                                                                    }
                                                                }

                                                            } while (!feof(fp8));
                                                            printf("\n");
                                                            fclose(fp8); //close the file and open it for each line
                                                            counter8++;
                                                        }
                                                    }
                                                }
                                                printf("This is the your output\n");
                                                for (int x = 0; x < 5; x++)
                                                {
                                                    for (int y = 0; y < 5; y++)
                                                    {
                                                        if (enteredMatrix8[x][y] == 1)
                                                        {
                                                            printf("*");
                                                        }
                                                        else if (enteredMatrix8[x][y] == 0)
                                                        {
                                                            printf(" ");
                                                        }
                                                    }
                                                    printf("\n");
                                                }

                                                end_seconds8 = time(NULL);
                                                //increment the total score
                                                total_score = total_score + (100 * (float)score8 / correctPosition8s);
                                                attemptCharacters++;

                                                printf("Your total score in %s is %d", g, score8);
                                                printf("\n Percentage score %.2f", 100 * (float)score8 / correctPosition8s);
                                                printf("\nThe character took you %ld  seconds to complete", (end_seconds8 - start_seconds8));
                                                printf("\nPossible correct positions %d", correctPosition8s);
                                                // fflush(stdin);
                                                // fflush(stdout);
                                                break;
                                            }

                                        default:
                                            break;
                                        }
                                    }
                                }else{
                                    ///still add the line for future attempting
                                    fprintf(temp, "%s %s %s %s %s %s %s %s %s %s %s %s %s\n", id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h);
                                }
                                
                            }
                            //remarks
                            ///after attempting the assignment .//upload the assignment for commenting
                            ///remove the attempted assignent from the list
                            char assignmentLine[256];///sent to attempts for commenting
                            int doneDate;
                            char finalName[100] = ".\\../textfiles/assignments/";
                            
                            // int last_seconds;
                            // int intial_seconds;

                            end_secondsM = time(NULL);

                            averageScore = (float)total_score / attemptCharacters;
                            averageTime = (int)end_secondsM - (int)start_secondsM;
                            // float averageScore;
                            // int averageTime;

                            // averageScore = (float)total_score / attemptCharacters;
                            // averageTime = end_secondsM - start_secondsM;

                            doneDate = end_secondsM;
                            printf("\nThe Total time taken is %ld  seconds to complete", averageTime);
                            printf("\n The average score is %.2f", (float)total_score / attemptCharacters);
                            printf("\n\n...A moment please ...uploading your assignment for teacher's remarks.....\n\n");
                            printf("\n Uploaded successfully login again to attempt another assignment\n\n");
                            //upload the assignment for remarks
                            fResults = fopen(attemptsUrl, "a+");
                            if (fResults == NULL)
                            {
                                return 1;
                            }

                            sprintf(assignmentLine, "%d %d %.2f %ld %s %s", doneAssignmentId, doneDate, averageScore, averageTime, "-");
                            fwrite(assignmentLine, sizeof(char), strlen(assignmentLine), fResults);
                            fclose(fResults);
                            cont = 1;

                            strcat(finalName, usercode);
                            strcat(finalName, ".txt");
                            fclose(fuse);
                            fclose(temp);
                            remove(assignmentUrl);
                            rename(".\\../textfiles/assignments/temp.txt", finalName);
                            return 1;
                            break;
                        case 2:
                            fa = fopen(attemptsUrl,"r");

                            char a_id[10];
                            char a_date[30];
                            char a_score[10];
                            char a_time[10];
                            char a_comment[100];
                            int date_seconds;
                            time_t date;
                            int a_attempted=0;
                            int not_attempted=0;

                            if (!fa)
                            {
                                printf("\nYou have not yet attempted any assignments");
            
                            }

                            
                            printf("=======================================Attempted assignments=================================================================\n");
                            
                            while (fscanf(fa, "%s %s %s %s %[^\n]*", a_id, a_date, a_score, a_time, a_comment) > 0)
                            {
                                date_seconds = atoi(a_date);
                                date = date_seconds;
                                printf(" id: %s\n Average score: %s\n Time took: %s(s)\n Teacher's comment: %s\n Done on: %s\n", a_id, a_score, a_time, a_comment, asctime(gmtime(&date)));
                                a_attempted = a_attempted + 1;
                                printf("========================================================================================================\n");
                            }
                            fclose(fa);
                            printf("=======================================Assignments not yet attempted=================================================================\n");
                            ///attempted assignments
                            fa = fopen(assignmentUrl, "r");
                            while (fscanf(fa, "%s %s %s %s %s %s %s %s %s %s %s %s %s", id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h) > 0)
                            {
                                not_attempted = not_attempted +1;
                                printf("id:%s startDate: %s  startTime: %s endtDate: %s  endTime: %s  %s %s %s %s %s %s %s %s\n", &id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h);

                            }
                            fclose(fa);
                            printf("You have attempted:%d\n You are left with:%d\n", a_attempted, not_attempted);
                            break;
                        case 3:
                        
                            /// first ask for the datefrom date two
                            ///first opne the file and inside it choose what to display depending on the 
                            //switch statement
                            do
                            {
                                fa = fopen(assignmentUrl, "r");
                                ///ask the pupil to enter their choice of checking
                                printf("Enter your prefered choice\n");
                                printf("\n1.Assignments before\n2.Assignments after\n3.Assignments between\n");
                                scanf("%d",&check);
                                switch (check)
                                {
                                case 1:
                                ///request the user to enter one date
                                printf("Enter year\n");
                                scanf("%d", &tmVar1.tm_year); /// enter year
                                printf("Enter month\n");
                                scanf("%d", &tmVar1.tm_mon);
                                printf("Enter day\n");
                                scanf("%d", &tmVar1.tm_mday);
                                tmVar1.tm_hour = 0;
                                tmVar1.tm_min = 0;
                                tmVar1.tm_sec = 0;
                                tmVar1.tm_isdst = 1;
                                tmVar1.tm_year -= 1900;
                                tmVar1.tm_mon--;

                                timeVar1 = mktime(&tmVar1);
                                //printf("time %d\n", timeVar1);
                                ///printf("You are yet to find the assignments\n");
                                ///diplay assignments whose end dates is less than thi some
                                while (fscanf(fa, "%s %s %s %s %s %s %s %s %s %s %s %s %s", id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h) > 0)
                                {
                                    // /convert date time to second in epoch
                                    //printf("%s\n",endDate);
                                    sscanf(endDate, "%d-%d-%d", &tmVar2.tm_year, &tmVar2.tm_mon, &tmVar2.tm_mday);
                                    tmVar2.tm_hour = 0;
                                    tmVar2.tm_min = 0;
                                    tmVar2.tm_sec = 0;
                                    tmVar2.tm_isdst = 1;
                                    tmVar2.tm_year -= 1900;
                                    tmVar2.tm_mon--;
                                    timeVar2 = mktime(&tmVar2);
                                    //printf("time %d\n", timeVar2);
                                    //printf("%d\n",expire_line);
                                    ///the if the end date is less and if its less the todayz date then it has expired
                                    if ((int)timeVar2 < (int)timeVar1){
                                      if ((int)timeVar2 < (int)expire_line)
                                        {
                                        
                                            printf("Expired:");
                                            printf("id:%s startDate: %s  startTime: %s endtDate: %s  endTime: %s  %s %s %s %s %s %s %s %s\n", &id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h);
                                        }else{
                                            printf("id:%s startDate: %s  startTime: %s endtDate: %s  endTime: %s  %s %s %s %s %s %s %s %s\n", &id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h);
                                        }

                                    }
                                }

                                break;
                                case 2:
                                    /// request the user to enter one date
                                    printf("Enter year\n");
                                    scanf("%d", &tmVar1.tm_year); /// enter year
                                    printf("Enter month\n");
                                    scanf("%d", &tmVar1.tm_mon);
                                    printf("Enter day\n");
                                    scanf("%d", &tmVar1.tm_mday);
                                    tmVar1.tm_hour = 0;
                                    tmVar1.tm_min = 0;
                                    tmVar1.tm_sec = 0;
                                    tmVar1.tm_isdst = 1;
                                    tmVar1.tm_year -= 1900;
                                    tmVar1.tm_mon--;

                                    timeVar1 = mktime(&tmVar1);
                                    while (fscanf(fa, "%s %s %s %s %s %s %s %s %s %s %s %s %s", id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h) > 0)
                                    {
                                        // /convert date time to second in epoch
                                        // printf("%s\n",endDate);
                                        sscanf(endDate, "%d-%d-%d", &tmVar2.tm_year, &tmVar2.tm_mon, &tmVar2.tm_mday);
                                        tmVar2.tm_hour = 0;
                                        tmVar2.tm_min = 0;
                                        tmVar2.tm_sec = 0;
                                        tmVar2.tm_isdst = 1;
                                        tmVar2.tm_year -= 1900;
                                        tmVar2.tm_mon--;
                                        timeVar2 = mktime(&tmVar2);
                                        // printf("time %d\n", timeVar2);
                                        // printf("%d\n",expire_line);
                                        /// the if the end date is less and if its less the todayz date then it has expired
                                        if ((int)timeVar2 > (int)timeVar1)
                                        {
                                            if ((int)timeVar2 < (int)expire_line)
                                            {

                                                printf("Expired:");
                                                printf("id:%s startDate: %s  startTime: %s endtDate: %s  endTime: %s  %s %s %s %s %s %s %s %s\n", &id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h);
                                            }
                                            else
                                            {
                                                printf("id:%s startDate: %s  startTime: %s endtDate: %s  endTime: %s  %s %s %s %s %s %s %s %s\n", &id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h);
                                            }
                                        }
                                    }
                                    case 3:
                                    printf("Enter the minimum date\n");
                                    printf("Enter year\n");
                                    scanf("%d", &tmVar1.tm_year); /// enter year
                                    printf("Enter month\n");
                                    scanf("%d", &tmVar1.tm_mon);
                                    printf("Enter day\n");
                                    scanf("%d", &tmVar1.tm_mday);
                                    tmVar1.tm_hour = 0;
                                    tmVar1.tm_min = 0;
                                    tmVar1.tm_sec = 0;
                                    tmVar1.tm_isdst = 1;
                                    tmVar1.tm_year -= 1900;
                                    tmVar1.tm_mon--;
                                    timeVar1 = mktime(&tmVar1);

                                    printf("Enter the maximum date\n");
                                    printf("Enter year\n");
                                    scanf("%d", &tmVar3.tm_year); /// enter year
                                    printf("Enter month\n");
                                    scanf("%d", &tmVar3.tm_mon);
                                    printf("Enter day\n");
                                    scanf("%d", &tmVar3.tm_mday);
                                    tmVar3.tm_hour = 0;
                                    tmVar3.tm_min = 0;
                                    tmVar3.tm_sec = 0;
                                    tmVar3.tm_isdst = 1;
                                    tmVar3.tm_year -= 1900;
                                    tmVar3.tm_mon--;
                                    timeVar3 = mktime(&tmVar3);
                                    while (fscanf(fa, "%s %s %s %s %s %s %s %s %s %s %s %s %s", id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h) > 0)
                                    {
                                        // /convert date time to second in epoch
                                        // printf("%s\n",endDate);
                                        sscanf(endDate, "%d-%d-%d", &tmVar2.tm_year, &tmVar2.tm_mon, &tmVar2.tm_mday);
                                        tmVar2.tm_hour = 0;
                                        tmVar2.tm_min = 0;
                                        tmVar2.tm_sec = 0;
                                        tmVar2.tm_isdst = 1;
                                        tmVar2.tm_year -= 1900;
                                        tmVar2.tm_mon--;
                                        timeVar2 = mktime(&tmVar2);
                                        // printf("time %d\n", timeVar2);
                                        // printf("%d\n",expire_line);
                                        /// the if the end date is less and if its less the todayz date then it has expired
                                        if ((int)timeVar1 <= (int)timeVar2 <= (int)timeVar3)
                                        {
                                            if ((int)timeVar2 < (int)expire_line)
                                            {

                                                printf("Expired:");
                                                printf("id:%s startDate: %s  startTime: %s endtDate: %s  endTime: %s  %s %s %s %s %s %s %s %s\n", &id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h);
                                            }
                                            else
                                            {
                                                printf("id:%s startDate: %s  startTime: %s endtDate: %s  endTime: %s  %s %s %s %s %s %s %s %s\n", &id, startDate, startTime, endDate, endTime, a, b, c, d, e, f, g, h);
                                            }
                                        }
                                    }

                                default:
                                    break;
                                }
                                
                            } while (check!=0);
                            fclose(fa);
                        case 0:
                           return 1;
                        default:
                            ch = 0;
                            break;
                        }

                    } while (ch != 0);
                }
            }
        }

        fclose(fp);

    } while (cont == 0);

    return 0;
}
