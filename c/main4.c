#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>
#include <math.h>

int col, row;
int matrix[5][5];
char *character = "A";
char position[20];
int input;
int enteredMatrix[5][5] = {0};
int numPositions = 0;
int counter = 0;
char srow[10];
char scol[10];
FILE *fp;
FILE *fLines;
int score;
char scounter[10];
char c;
time_t start_seconds;
time_t end_seconds;
void main()
{
    start_seconds = time(NULL);
    printf("Enter either 0 or 1 \n \n1.For correct postion \n0.For Invalid postion");
    //open correct positions for marking
    fLines = fopen("./positions/V.txt", "r");

    // Extract characters from file and store in character c
    while (!feof(fLines))
    {
        c = fgetc(fLines);
        if (c == '\n')
        {
            numPositions++;
        }
    }

    printf("%d poitions", numPositions);
    // Close the file
    fclose(fLines);

    //number of lines

    for (int col = 0; col < 5; col++)
    {
        for (int row = 0; row < 5; row++)
        {
            fp = fopen("./positions/V.txt", "r");
            printf("\n%s[%d][%d]:\n", character, col, row);
            scanf("%d", &input);

            //printf("%d",input);
            enteredMatrix[col][row] = input;
            if (input == 1)
            {

                do
                {
                    ///convert the counter to  astring
                    itoa(counter, scounter, 10);

                    while (fscanf(fp, "%s", position) > 0)
                    {
                        if (strcmp(position, scounter) == 0)
                        {
                            score++;
                            printf("Current score is %d", score);
                            //printf("Current score is %s,%s",scounter,position);
                        }
                    }
                    ////here compare the
                } while (!feof(fp));
            }

            printf("\n");
            fclose(fp); //close the file and open it for each line
            counter++;
        }
    }

    for (int x = 0; x < 5; x++)
    {
        for (int y = 0; y < 5; y++)
        {
            if (enteredMatrix[x][y] == 1)
            {
                printf("*");
            }
            else if (enteredMatrix[x][y] == 0)
            {
                printf(" ");
            }
        }
        printf("\n");
    }

    end_seconds = time(NULL);
    printf("Your score is %d", score);
    printf("\n Percentage score %.2f", 100 * (float)score / numPositions);
    printf("\nThe character took yoy %ld  seconds to execute \n", (end_seconds - start_seconds));
    printf("\nPossible correct positions %d", numPositions);
}