import StatisticsCard from '@/Components/Card/StatisticsCard';
import PersentasiAnggaranSektorCSRChart from '@/Components/Chart/PersentasiAnggaranSektorCSRChart';
import RealisasiKecamatanCSR from '@/Components/Chart/RealisasiKecamatanCSR';
import RealisasiPTCSR from '@/Components/Chart/RealisasiPTCSR';
import RealisasiSektorCSR from '@/Components/Chart/RealisasiSektorCSR';
import DashboardFilter from '@/Components/Select/DashboardFilter';
import { Card, CardContent } from '@/Components/UI/Card';
import MainDashboardLayout from '@/Layouts/MainDashboardLayout';
import { PageProps } from '@/types';
import { Head } from '@inertiajs/react';
import {
    RiDashboardLine,
    RiMoneyDollarCircleLine,
    RiUser3Line,
    RiVerifiedBadgeLine,
} from '@remixicon/react';

export default function Dashboard({
    analytics,
    anggaranSektorCSR,
    anggaranMitrasCSR,
    anggaranKecamatansCSR,
}: PageProps) {
    return (
        <MainDashboardLayout>
            <Head title="Dashboard" />

            <section className="space-y-6">
                <DashboardFilter />
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
                        value={`Rp. ${analytics.total_anggaran_realisasi}`}
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
                            <PersentasiAnggaranSektorCSRChart
                                chartData={anggaranSektorCSR}
                            />
                        </div>
                        <div className="space-y-5">
                            <h3 className="whitespace-nowrap text-[22px] font-semibold leading-none tracking-tight">
                                Total Realisasi Sektor CSR
                            </h3>
                            <RealisasiSektorCSR chartData={anggaranSektorCSR} />
                        </div>
                        <div className="space-y-5">
                            <h3 className="whitespace-nowrap text-[22px] font-semibold leading-none tracking-tight">
                                Persentase Total Realisasi Berdasarkan PT
                            </h3>
                            <RealisasiPTCSR chartData={anggaranMitrasCSR} />
                        </div>
                        <div className="space-y-5">
                            <h3 className="whitespace-nowrap text-[22px] font-semibold leading-none tracking-tight">
                                Persentase Total Realisasi Berdasarkan Kecamatan
                            </h3>
                            <RealisasiKecamatanCSR
                                chartData={anggaranKecamatansCSR}
                            />
                        </div>
                    </CardContent>
                </Card>
            </section>
        </MainDashboardLayout>
    );
}
