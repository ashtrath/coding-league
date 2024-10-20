import StatisticsCard from '@/Components/Card/StatisticsCard';
import PersentaseAnggaranBySektorChart from '@/Components/Chart/PersentaseAnggaranBySektorChart';
import TotalRealisasiByKecamatanChart from '@/Components/Chart/TotalRealisasiByKecamatanChart';
import TotalRealisasiByMitraChart from '@/Components/Chart/TotalRealisasiByMitraChart';
import TotalRealisasiBySektorChart from '@/Components/Chart/TotalRealisasiBySektorChart';
import { Card, CardContent } from '@/Components/UI/Card';
import MainDashboardLayout from '@/Layouts/MainDashboardLayout';
import { formatCurrency } from '@/lib/utils';
import { PageProps } from '@/types';
import { Head } from '@inertiajs/react';
import {
    RiDashboardLine,
    RiMoneyDollarCircleLine,
    RiUser3Line,
    RiVerifiedBadgeLine,
} from '@remixicon/react';

interface DashboardAnalytics {
    chartData: {
        sektor: {
            name: string;
            total_anggaran: number;
            persentase: number;
        }[];
        mitra: {
            name: string;
            total_anggaran: number;
            persentase: number;
        }[];
        kecamatan: {
            name: string;
            total_anggaran: number;
            persentase: number;
        }[];
    };
    analytics: {
        total_project: number;
        total_project_terealisasi: number;
        total_anggaran_realisasi: number;
        total_mitra?: number;
    };
}

export default function Dashboard({
    data,
}: PageProps<{ data: DashboardAnalytics }>) {
    const { analytics, chartData } = data;

    return (
        <MainDashboardLayout>
            <Head title="Dashboard" />

            <section className="space-y-6">
                {/* <DashboardFilter /> */}
                <h2 className="text-[28px] font-semibold leading-[44px] tracking-tight text-gray-900">
                    Data Statistik
                </h2>
                <div className="flex items-baseline gap-6">
                    <StatisticsCard
                        icon={RiDashboardLine}
                        title="Total Proyek CSR"
                        value={analytics.total_project}
                        color="orange"
                    />
                    <StatisticsCard
                        icon={RiVerifiedBadgeLine}
                        title="Proyek Terealisasi"
                        value={analytics.total_project_terealisasi}
                        color="purple"
                    />
                    <StatisticsCard
                        icon={RiUser3Line}
                        title="Mitra Bergabung"
                        value={analytics.total_mitra}
                        color="blue"
                    />
                    <StatisticsCard
                        icon={RiMoneyDollarCircleLine}
                        title="Total Dana Realisasi"
                        value={formatCurrency(
                            analytics.total_anggaran_realisasi,
                            'id-ID',
                            'IDR',
                        )}
                        color="green"
                    />
                </div>
            </section>
            <section className="mt-[60px] space-y-6">
                <h2 className="text-[28px] font-semibold leading-[44px] tracking-tight text-gray-900">
                    Realisasi Proyek CSR
                </h2>
                <Card>
                    <CardContent className="grid grid-cols-2 gap-5 gap-y-8 p-10">
                        <div className="space-y-5">
                            <h3 className="whitespace-nowrap text-[22px] font-semibold leading-none tracking-tight">
                                Persentase Total Realisasi Berdasarkan Sektor
                                CSR
                            </h3>
                            <PersentaseAnggaranBySektorChart
                                chartData={chartData.sektor}
                            />
                        </div>
                        <div className="space-y-5">
                            <h3 className="whitespace-nowrap text-[22px] font-semibold leading-none tracking-tight">
                                Total Realisasi Sektor CSR
                            </h3>
                            <TotalRealisasiBySektorChart
                                chartData={chartData.sektor}
                            />
                        </div>
                        <div className="space-y-5">
                            <h3 className="whitespace-nowrap text-[22px] font-semibold leading-none tracking-tight">
                                Persentase Total Realisasi Berdasarkan PT
                            </h3>
                            <TotalRealisasiByMitraChart
                                chartData={chartData.mitra}
                            />
                        </div>
                        <div className="space-y-5">
                            <h3 className="whitespace-nowrap text-[22px] font-semibold leading-none tracking-tight">
                                Persentase Total Realisasi Berdasarkan Kecamatan
                            </h3>
                            <TotalRealisasiByKecamatanChart
                                chartData={chartData.kecamatan}
                            />
                        </div>
                    </CardContent>
                </Card>
            </section>
        </MainDashboardLayout>
    );
}
