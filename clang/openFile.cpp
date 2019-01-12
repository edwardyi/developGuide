#include <stdio.h>

int main(void){
    const int INF = 1000000000;
    FILE *fin = fopen("in.data", "rb");
    FILE *fout = fopen("out.data", "wb");
    int input, total, average, min, max;
    while(fscanf(fin, "%s" , input)) {
        // fscanf讀取出來的格式取決於寫入的格式

    }
    return 0; 
}