#include<stdio.h>

int main()
{
	// 沒有給會從1開始計算 
	int n = 0, s = 0, input, max, min;
	while(scanf("%d", &input) ==1)
	{
		s = s + input;
		if (min >= input) min = input; printf("min");
		if (max <= input) max = input; printf("max");
		n = n + 1; 
	}
//	s = (double)s / (double)n;
	printf("%d %d %d %0.2f",n ,min, max, (double)s/n);
	return 0;
} 
