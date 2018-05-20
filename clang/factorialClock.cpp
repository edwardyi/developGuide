#include <stdio.h> 
#include <time.h> 

int main()
{
	const int MOD = 100000; // 每次取mod 
	int factorial=1;
	int n,S=0; //宣告輸入與加總
	// S如果沒有給值的話預設會是1,加總出來的結果會不同 
	scanf("%d", &n);
	for(int i=1; i<=n; i++)
	{
		// 讓i從1開始
		factorial = 1;
		for(int j=1; j<=i; j++){
			factorial = factorial * j % MOD; 
		}
		S =  S + factorial;
	}
	printf("%d", S);
	// 用每秒多少時脈去除
	printf("共花:%0.2f(sec)",  (double) clock() / CLOCKS_PER_SEC);
	return 0;
}
