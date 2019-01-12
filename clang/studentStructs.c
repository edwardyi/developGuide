#include <stdio.h>
#include <cs50.h>
#include <stdlib.h>
#include <string.h>

 typedef struct {
    string name;
    string dorm;
}
student;

int main(void)
{
    //分配空間給學生
    int enrollment = get_int("註冊人數:");
    student students[enrollment];

    // 取得student名稱和住宿位置
    for (int i=0; i<enrollment; i++) {
        students[i].name = get_string("姓名: ");
        students[i].dorm = get_string("住宿位置: ");
    }

    FILE *file = fopen("students.csv", "w+");
    if(file)
    {
        for(int i =0; i< enrollment; i++) {
            fprintf(file, "%s, %s\n", students[i].name, students[i].dorm);
        }

        fclose(file);
    }

}
