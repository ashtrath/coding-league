import { createChartConfig } from '@/lib/chart-helper';
import { AnggaranSektorCSR } from '@/types';
import { Pie, PieChart } from 'recharts';
import {
    ChartContainer,
    ChartLegend,
    ChartLegendContent,
    ChartTooltip,
    ChartTooltipContent,
} from '../UI/Chart';

interface PersentasiAnggaranSektorCSRChartProps {
    chartData: AnggaranSektorCSR[];
}

const PersentasiAnggaranSektorCSRChart = ({
    chartData,
}: PersentasiAnggaranSektorCSRChartProps) => {
    const chartConfig = createChartConfig(chartData, 'name', 'percentage');

    return (
        <ChartContainer
            config={chartConfig}
            className="aspect-square max-h-[250px] w-full"
        >
            <PieChart className="w-full">
                <ChartTooltip
                    content={
                        <ChartTooltipContent
                            nameKey="percentage"
                            labelKey="sektor"
                            indicator="line"
                            className="min-w-40"
                        />
                    }
                />
                <Pie
                    data={chartData}
                    dataKey="percentage"
                    stroke="white"
                    strokeWidth={2}
                />
                <ChartLegend
                    content={<ChartLegendContent nameKey="name" />}
                    layout="vertical"
                    verticalAlign="middle"
                    align="right"
                    className="-translate-y-2 flex-wrap gap-2 [&>*]:items-center [&>*]:justify-center"
                />
            </PieChart>
        </ChartContainer>
    );
};

export default PersentasiAnggaranSektorCSRChart;
