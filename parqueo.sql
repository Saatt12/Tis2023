--
-- PostgreSQL database dump
--

-- Dumped from database version 15.2 (Debian 15.2-1.pgdg110+1)
-- Dumped by pg_dump version 15.2 (Debian 15.2-1.pgdg110+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: announcements; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.announcements (
    id bigint NOT NULL,
    fecha_inicio date,
    fecha_fin date,
    descuento integer,
    multa integer,
    monto_mes double precision,
    monto_multa double precision,
    monto_descuento double precision,
    monto_anual double precision,
    cantidad_espacios integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    image character varying(255)
);


ALTER TABLE public.announcements OWNER TO postgres;

--
-- Name: announcements_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.announcements_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.announcements_id_seq OWNER TO postgres;

--
-- Name: announcements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.announcements_id_seq OWNED BY public.announcements.id;


--
-- Name: cargos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cargos (
    id bigint NOT NULL,
    nom_cargo character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.cargos OWNER TO postgres;

--
-- Name: cargos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cargos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cargos_id_seq OWNER TO postgres;

--
-- Name: cargos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cargos_id_seq OWNED BY public.cargos.id;


--
-- Name: claim_managers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.claim_managers (
    id bigint NOT NULL,
    user_id bigint,
    claim_id bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.claim_managers OWNER TO postgres;

--
-- Name: claim_managers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.claim_managers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.claim_managers_id_seq OWNER TO postgres;

--
-- Name: claim_managers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.claim_managers_id_seq OWNED BY public.claim_managers.id;


--
-- Name: claims; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.claims (
    id bigint NOT NULL,
    client_id bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.claims OWNER TO postgres;

--
-- Name: claims_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.claims_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.claims_id_seq OWNER TO postgres;

--
-- Name: claims_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.claims_id_seq OWNED BY public.claims.id;


--
-- Name: conversation_messages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.conversation_messages (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    message character varying(255),
    type character varying(255),
    sender_id bigint NOT NULL,
    receiver_id bigint NOT NULL,
    conversation_id bigint
);


ALTER TABLE public.conversation_messages OWNER TO postgres;

--
-- Name: conversation_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.conversation_messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.conversation_messages_id_seq OWNER TO postgres;

--
-- Name: conversation_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.conversation_messages_id_seq OWNED BY public.conversation_messages.id;


--
-- Name: conversations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.conversations (
    id bigint NOT NULL,
    sender_id bigint NOT NULL,
    receiver_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.conversations OWNER TO postgres;

--
-- Name: conversations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.conversations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.conversations_id_seq OWNER TO postgres;

--
-- Name: conversations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.conversations_id_seq OWNED BY public.conversations.id;


--
-- Name: dias_trabajo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dias_trabajo (
    id bigint NOT NULL,
    nom_dia character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.dias_trabajo OWNER TO postgres;

--
-- Name: dias_trabajo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dias_trabajo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dias_trabajo_id_seq OWNER TO postgres;

--
-- Name: dias_trabajo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dias_trabajo_id_seq OWNED BY public.dias_trabajo.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: horarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.horarios (
    id bigint NOT NULL,
    hora_entrada time(0) without time zone,
    hora_salida time(0) without time zone,
    nom_turno character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.horarios OWNER TO postgres;

--
-- Name: horarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.horarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.horarios_id_seq OWNER TO postgres;

--
-- Name: horarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.horarios_id_seq OWNED BY public.horarios.id;


--
-- Name: income_vehicles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.income_vehicles (
    id bigint NOT NULL,
    hora_entrada time(0) without time zone,
    hora_salida time(0) without time zone,
    vehicle_id bigint,
    user_id bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.income_vehicles OWNER TO postgres;

--
-- Name: income_vehicles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.income_vehicles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.income_vehicles_id_seq OWNER TO postgres;

--
-- Name: income_vehicles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.income_vehicles_id_seq OWNED BY public.income_vehicles.id;


--
-- Name: messages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.messages (
    id bigint NOT NULL,
    content character varying(255),
    type character varying(255),
    sender_id bigint,
    claim_id bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    is_read boolean DEFAULT false NOT NULL
);


ALTER TABLE public.messages OWNER TO postgres;

--
-- Name: messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.messages_id_seq OWNER TO postgres;

--
-- Name: messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.messages_id_seq OWNED BY public.messages.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: parkings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.parkings (
    id bigint NOT NULL,
    name character varying(255),
    status character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.parkings OWNER TO postgres;

--
-- Name: parkings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.parkings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.parkings_id_seq OWNER TO postgres;

--
-- Name: parkings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.parkings_id_seq OWNED BY public.parkings.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO postgres;

--
-- Name: payments; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.payments (
    id bigint NOT NULL,
    type character varying(255),
    number double precision,
    plan character varying(255),
    amount double precision,
    count integer,
    is_active boolean,
    user_id bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    status character varying(255),
    comprobante character varying(255)
);


ALTER TABLE public.payments OWNER TO postgres;

--
-- Name: payments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.payments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.payments_id_seq OWNER TO postgres;

--
-- Name: payments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.payments_id_seq OWNED BY public.payments.id;


--
-- Name: request_forms; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.request_forms (
    id bigint NOT NULL,
    user_id bigint,
    vehicle_id bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    parking_id bigint,
    announcement_id bigint
);


ALTER TABLE public.request_forms OWNER TO postgres;

--
-- Name: request_forms_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.request_forms_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.request_forms_id_seq OWNER TO postgres;

--
-- Name: request_forms_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.request_forms_id_seq OWNED BY public.request_forms.id;


--
-- Name: rol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rol (
    id bigint NOT NULL,
    nom_role character varying(255),
    horario_id bigint,
    dia_trabajo_id bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.rol OWNER TO postgres;

--
-- Name: rol_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rol_id_seq OWNER TO postgres;

--
-- Name: rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rol_id_seq OWNED BY public.rol.id;


--
-- Name: unidades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.unidades (
    id bigint NOT NULL,
    nom_unidad character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.unidades OWNER TO postgres;

--
-- Name: unidades_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.unidades_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.unidades_id_seq OWNER TO postgres;

--
-- Name: unidades_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.unidades_id_seq OWNED BY public.unidades.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    ci character varying(255),
    celular character varying(255),
    cargo_id bigint NOT NULL,
    unidad_id bigint NOT NULL,
    rol_id bigint
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: vehicles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vehicles (
    id bigint NOT NULL,
    user_id bigint,
    placa character varying(255),
    marca character varying(255),
    modelo character varying(255),
    plan_pago character varying(255),
    image character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    hour_vehicle_id bigint
);


ALTER TABLE public.vehicles OWNER TO postgres;

--
-- Name: vehicles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vehicles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vehicles_id_seq OWNER TO postgres;

--
-- Name: vehicles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vehicles_id_seq OWNED BY public.vehicles.id;


--
-- Name: announcements id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.announcements ALTER COLUMN id SET DEFAULT nextval('public.announcements_id_seq'::regclass);


--
-- Name: cargos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cargos ALTER COLUMN id SET DEFAULT nextval('public.cargos_id_seq'::regclass);


--
-- Name: claim_managers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.claim_managers ALTER COLUMN id SET DEFAULT nextval('public.claim_managers_id_seq'::regclass);


--
-- Name: claims id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.claims ALTER COLUMN id SET DEFAULT nextval('public.claims_id_seq'::regclass);


--
-- Name: conversation_messages id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conversation_messages ALTER COLUMN id SET DEFAULT nextval('public.conversation_messages_id_seq'::regclass);


--
-- Name: conversations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conversations ALTER COLUMN id SET DEFAULT nextval('public.conversations_id_seq'::regclass);


--
-- Name: dias_trabajo id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dias_trabajo ALTER COLUMN id SET DEFAULT nextval('public.dias_trabajo_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: horarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.horarios ALTER COLUMN id SET DEFAULT nextval('public.horarios_id_seq'::regclass);


--
-- Name: income_vehicles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.income_vehicles ALTER COLUMN id SET DEFAULT nextval('public.income_vehicles_id_seq'::regclass);


--
-- Name: messages id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.messages ALTER COLUMN id SET DEFAULT nextval('public.messages_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: parkings id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parkings ALTER COLUMN id SET DEFAULT nextval('public.parkings_id_seq'::regclass);


--
-- Name: payments id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments ALTER COLUMN id SET DEFAULT nextval('public.payments_id_seq'::regclass);


--
-- Name: request_forms id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.request_forms ALTER COLUMN id SET DEFAULT nextval('public.request_forms_id_seq'::regclass);


--
-- Name: rol id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol ALTER COLUMN id SET DEFAULT nextval('public.rol_id_seq'::regclass);


--
-- Name: unidades id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidades ALTER COLUMN id SET DEFAULT nextval('public.unidades_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: vehicles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vehicles ALTER COLUMN id SET DEFAULT nextval('public.vehicles_id_seq'::regclass);


--
-- Data for Name: announcements; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.announcements (id, fecha_inicio, fecha_fin, descuento, multa, monto_mes, monto_multa, monto_descuento, monto_anual, cantidad_espacios, created_at, updated_at, image) VALUES (1, '2012-10-06', '2010-11-21', 5, 2, 84, 90, 39, 39, 92, '2023-05-25 23:33:32', '2023-05-25 23:33:32', 'announcement/1685057612.jpeg');
INSERT INTO public.announcements (id, fecha_inicio, fecha_fin, descuento, multa, monto_mes, monto_multa, monto_descuento, monto_anual, cantidad_espacios, created_at, updated_at, image) VALUES (2, '2023-05-11', '2023-07-20', 5, 2, 33, 68, 60, 46, 9, '2023-05-26 07:50:16', '2023-05-26 07:50:16', 'announcement/1685087416.jpeg');


--
-- Data for Name: cargos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.cargos (id, nom_cargo, created_at, updated_at) VALUES (1, 'Administrativo', NULL, NULL);


--
-- Data for Name: claim_managers; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: claims; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.claims (id, client_id, created_at, updated_at) VALUES (15, 4, '2023-05-07 22:40:21', '2023-05-07 22:40:21');
INSERT INTO public.claims (id, client_id, created_at, updated_at) VALUES (16, 5, '2023-05-07 22:40:21', '2023-05-07 22:40:21');
INSERT INTO public.claims (id, client_id, created_at, updated_at) VALUES (17, 6, '2023-05-07 22:40:21', '2023-05-07 22:40:21');
INSERT INTO public.claims (id, client_id, created_at, updated_at) VALUES (18, 7, '2023-05-07 22:40:21', '2023-05-07 22:40:21');
INSERT INTO public.claims (id, client_id, created_at, updated_at) VALUES (19, 19, '2023-05-07 22:40:21', '2023-05-07 22:40:21');
INSERT INTO public.claims (id, client_id, created_at, updated_at) VALUES (20, 20, '2023-05-07 22:40:21', '2023-05-07 22:40:21');


--
-- Data for Name: conversation_messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.conversation_messages (id, created_at, updated_at, message, type, sender_id, receiver_id, conversation_id) VALUES (15, '2023-05-26 05:47:32', '2023-05-26 05:47:32', 'como estas bro', 'text', 1, 22, 7);
INSERT INTO public.conversation_messages (id, created_at, updated_at, message, type, sender_id, receiver_id, conversation_id) VALUES (16, '2023-06-02 03:12:09', '2023-06-02 03:12:09', 'hola que tal', 'text', 23, 17, 8);
INSERT INTO public.conversation_messages (id, created_at, updated_at, message, type, sender_id, receiver_id, conversation_id) VALUES (17, '2023-06-02 03:12:09', '2023-06-02 03:12:09', 'hola que tal', 'text', 23, 18, 9);


--
-- Data for Name: conversations; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.conversations (id, sender_id, receiver_id, created_at, updated_at) VALUES (7, 1, 22, '2023-05-26 05:47:32', '2023-05-26 05:47:32');
INSERT INTO public.conversations (id, sender_id, receiver_id, created_at, updated_at) VALUES (8, 23, 17, '2023-06-02 03:12:09', '2023-06-02 03:12:09');
INSERT INTO public.conversations (id, sender_id, receiver_id, created_at, updated_at) VALUES (9, 23, 18, '2023-06-02 03:12:09', '2023-06-02 03:12:09');


--
-- Data for Name: dias_trabajo; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: horarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.horarios (id, hora_entrada, hora_salida, nom_turno, created_at, updated_at) VALUES (9, '12:00:00', '02:00:00', 'Lucius Benton', '2023-04-14 06:53:30', '2023-04-14 06:57:48');
INSERT INTO public.horarios (id, hora_entrada, hora_salida, nom_turno, created_at, updated_at) VALUES (8, '15:00:00', '00:00:00', 'Dana Morse', '2023-04-14 06:53:24', '2023-04-14 06:58:27');
INSERT INTO public.horarios (id, hora_entrada, hora_salida, nom_turno, created_at, updated_at) VALUES (7, '10:00:00', '22:00:00', 'September Daniel', '2023-04-14 06:00:45', '2023-04-14 06:58:42');
INSERT INTO public.horarios (id, hora_entrada, hora_salida, nom_turno, created_at, updated_at) VALUES (10, '21:00:00', '03:00:00', 'Noelani Faulkner', '2023-04-14 06:58:52', '2023-04-14 06:58:52');
INSERT INTO public.horarios (id, hora_entrada, hora_salida, nom_turno, created_at, updated_at) VALUES (11, '16:00:00', '17:00:00', 'asdasd', '2023-04-14 07:30:35', '2023-04-14 07:30:35');


--
-- Data for Name: income_vehicles; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.income_vehicles (id, hora_entrada, hora_salida, vehicle_id, user_id, created_at, updated_at) VALUES (7, '15:33:00', '15:55:00', 6, 19, '2023-05-23 06:56:08', '2023-05-26 06:57:23');
INSERT INTO public.income_vehicles (id, hora_entrada, hora_salida, vehicle_id, user_id, created_at, updated_at) VALUES (8, '23:38:00', '10:02:00', 6, 19, '2023-05-26 06:58:06', '2023-05-26 07:16:59');
INSERT INTO public.income_vehicles (id, hora_entrada, hora_salida, vehicle_id, user_id, created_at, updated_at) VALUES (9, '01:17:00', '12:17:00', 6, 19, '2023-06-02 03:15:30', '2023-06-02 03:15:30');


--
-- Data for Name: messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (58, 'envio desde el parquero', 'text', 22, 15, '2023-05-18 06:47:09', '2023-05-18 06:47:09', false);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (60, 'envio desde el parquero', 'text', 22, 17, '2023-05-18 06:47:09', '2023-05-18 06:47:09', false);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (61, 'envio desde el parquero', 'text', 22, 18, '2023-05-18 06:47:09', '2023-05-18 06:47:09', false);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (62, 'envio desde el parquero', 'text', 22, 19, '2023-05-18 06:47:09', '2023-05-18 06:47:09', false);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (63, 'envio desde el parquero', 'text', 22, 20, '2023-05-18 06:47:09', '2023-05-18 06:47:09', false);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (52, 'hola a todos', 'text', 1, 16, '2023-05-07 22:40:21', '2023-05-26 07:17:54', true);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (57, 'hola admin', 'text', 5, 16, '2023-05-07 22:42:24', '2023-05-26 07:17:54', true);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (59, 'envio desde el parquero', 'text', 22, 16, '2023-05-18 06:47:09', '2023-05-26 07:17:54', true);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (51, 'hola a todos', 'text', 1, 15, '2023-05-07 22:40:21', '2023-05-07 22:40:21', false);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (53, 'hola a todos', 'text', 1, 17, '2023-05-07 22:40:21', '2023-05-07 22:40:21', false);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (54, 'hola a todos', 'text', 1, 18, '2023-05-07 22:40:21', '2023-05-07 22:40:21', false);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (55, 'hola a todos', 'text', 1, 19, '2023-05-07 22:40:21', '2023-05-07 22:40:21', false);
INSERT INTO public.messages (id, content, type, sender_id, claim_id, created_at, updated_at, is_read) VALUES (56, 'hola a todos', 'text', 1, 20, '2023-05-07 22:40:21', '2023-05-07 22:40:21', false);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.migrations (id, migration, batch) VALUES (17, '2014_10_12_000000_create_users_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (18, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (19, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (20, '2023_04_12_204606_create_cargos_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (21, '2023_04_12_204656_create_unidades_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (22, '2023_04_12_204840_add_ci_to_users_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (23, '2023_04_14_005816_create_horario_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (24, '2023_04_14_011222_create_dias_trabajo_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (25, '2023_04_14_011400_create_rol_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (26, '2023_04_14_011913_add_role_id_to_users_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (27, '2023_05_02_191302_create_vehicles_table', 2);
INSERT INTO public.migrations (id, migration, batch) VALUES (28, '2023_05_03_105241_create_payments_table', 3);
INSERT INTO public.migrations (id, migration, batch) VALUES (29, '2023_05_03_105321_create_request_forms_table', 4);
INSERT INTO public.migrations (id, migration, batch) VALUES (30, '2023_05_03_105434_create_parkings_table', 4);
INSERT INTO public.migrations (id, migration, batch) VALUES (31, '2023_05_03_111112_create_claims_table', 4);
INSERT INTO public.migrations (id, migration, batch) VALUES (32, '2023_05_03_111637_create_claim_managers_table', 4);
INSERT INTO public.migrations (id, migration, batch) VALUES (33, '2023_05_03_112734_create_messages_table', 4);
INSERT INTO public.migrations (id, migration, batch) VALUES (34, '2023_05_03_113650_add_parking_id_to_request_forms_table', 4);
INSERT INTO public.migrations (id, migration, batch) VALUES (35, '2023_05_07_211911_add_is_read_to_messages_table', 5);
INSERT INTO public.migrations (id, migration, batch) VALUES (36, '2023_05_25_142415_create_conversations_table', 6);
INSERT INTO public.migrations (id, migration, batch) VALUES (37, '2023_05_25_142848_create_announcements_table', 6);
INSERT INTO public.migrations (id, migration, batch) VALUES (38, '2023_05_25_143307_create_income_vehicles_table', 6);
INSERT INTO public.migrations (id, migration, batch) VALUES (39, '2023_05_25_155108_add_status_comprobante_to_payments_table', 6);
INSERT INTO public.migrations (id, migration, batch) VALUES (40, '2023_05_25_182315_add_image_to_announcements_table', 6);
INSERT INTO public.migrations (id, migration, batch) VALUES (41, '2023_05_25_223006_remove_fields_from_conversation', 6);
INSERT INTO public.migrations (id, migration, batch) VALUES (42, '2023_05_25_223243_create_conversation_messages_table', 6);
INSERT INTO public.migrations (id, migration, batch) VALUES (43, '2023_05_26_035850_add_field_conversation_id_to_conversation_messages_table', 7);
INSERT INTO public.migrations (id, migration, batch) VALUES (44, '2023_05_26_062700_add_field_hour_vehicle_id_to_vehicles_table', 8);
INSERT INTO public.migrations (id, migration, batch) VALUES (45, '2023_06_01_202644_add_announcement_id_to_request_forms_table', 9);


--
-- Data for Name: parkings; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (3, 'espacio 24183-5925', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (4, 'espacio 39739-2185', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (5, 'espacio 01065-2367', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (6, 'espacio 28256', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (7, 'espacio 12947', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (8, 'espacio 75628-6980', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (9, 'espacio 16809-4671', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (10, 'espacio 38104-0075', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (11, 'espacio 70739-9469', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (12, 'espacio 90273-1266', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (13, 'espacio 62937-5726', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (14, 'espacio 72084', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (15, 'espacio 08288', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (16, 'espacio 22629-9602', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (17, 'espacio 68336-8948', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (18, 'espacio 44563', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (19, 'espacio 74026', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (20, 'espacio 70227-1950', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (21, 'espacio 73708-1653', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (22, 'espacio 57631-2023', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (23, 'espacio 96283-8989', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (24, 'espacio 10921-1278', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (26, 'espacio 85825', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (27, 'espacio 52533', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (28, 'espacio 64272', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (29, 'espacio 01674-0800', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (30, 'espacio 85109', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (31, 'espacio 74431-3554', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (32, 'espacio 25603', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (34, 'espacio 12053', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (35, 'espacio 72182', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (36, 'espacio 24538-2136', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (37, 'espacio 16794', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (38, 'espacio 82157-7602', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (39, 'espacio 19209-1053', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (40, 'espacio 22547', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (41, 'espacio 61454-7130', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (42, 'espacio 25890-5964', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (43, 'espacio 97168', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (44, 'espacio 69438-9557', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (45, 'espacio 32552-1278', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (46, 'espacio 13631', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (47, 'espacio 53888-3856', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (48, 'espacio 27385-0091', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (49, 'espacio 96337-2788', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (50, 'espacio 06500-4914', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (51, 'espacio 38545', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (52, 'espacio 55109-0297', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (53, 'espacio 39484', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (54, 'espacio 45782-5700', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (55, 'espacio 58656', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (56, 'espacio 94701-9991', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (57, 'espacio 02718', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (58, 'espacio 46589-0133', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (59, 'espacio 47153-5536', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (60, 'espacio 80359-0067', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (61, 'espacio 25007-0220', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (62, 'espacio 06912', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (63, 'espacio 23589-9518', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (64, 'espacio 65956', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (65, 'espacio 05401', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (66, 'espacio 33038', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (67, 'espacio 01409-5772', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (68, 'espacio 26077', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (69, 'espacio 18666-4230', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (70, 'espacio 86957', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (71, 'espacio 86908-5776', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (72, 'espacio 53398-8575', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (73, 'espacio 33623', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (74, 'espacio 85712-8978', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (75, 'espacio 71510', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (77, 'espacio 86027-7768', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (78, 'espacio 09153', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (79, 'espacio 00250-7959', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (80, 'espacio 37036-4629', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (81, 'espacio 87294', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (82, 'espacio 60417-6823', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (83, 'espacio 71178', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (85, 'espacio 40170', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (86, 'espacio 18769-5335', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (87, 'espacio 67738-9689', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (88, 'espacio 54261', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (89, 'espacio 75190', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (90, 'espacio 18985-9033', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (91, 'espacio 67209-9746', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (92, 'espacio 59650-1530', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (93, 'espacio 87491-8392', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (94, 'espacio 05875-6602', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (95, 'espacio 45654', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (96, 'espacio 93962-8230', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (98, 'espacio 26431', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (99, 'espacio 74220', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (100, 'espacio 69840', 'available', '2023-05-03 11:56:34', '2023-05-03 11:56:34');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (25, 'espacio 37449-3414', 'unavailable', '2023-05-03 11:56:34', '2023-05-07 07:34:43');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (76, 'espacio 97737-2858', 'available', '2023-05-03 11:56:34', '2023-05-07 05:57:09');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (2, 'espacio 63238-7497', 'unavailable', '2023-05-03 11:56:34', '2023-05-07 07:35:19');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (33, 'espacio 97008-3626', 'available', '2023-05-03 11:56:34', '2023-05-07 07:33:39');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (1, 'espacio 97528-4911', 'available', '2023-05-03 11:56:34', '2023-05-07 07:34:43');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (97, 'espacio 68452', 'available', '2023-05-03 11:56:34', '2023-05-07 07:35:19');
INSERT INTO public.parkings (id, name, status, created_at, updated_at) VALUES (84, 'espacio 59697', 'available', '2023-05-03 11:56:34', '2023-05-07 07:33:11');


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: payments; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (2, 'manual', 640, 'mensual', 50, 6, NULL, 20, '2023-05-04 05:42:27', '2023-05-04 05:42:27', NULL, NULL);
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (3, 'qr', 497, 'anual', 452, NULL, NULL, 20, '2023-05-04 05:44:13', '2023-05-04 05:44:13', NULL, NULL);
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (4, 'qr', 154, 'mensual', 1654, 9, NULL, 20, '2023-05-04 05:50:36', '2023-05-04 05:50:36', NULL, NULL);
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (5, 'qr', 91, 'anual', 33, NULL, NULL, 20, '2023-05-04 05:55:27', '2023-05-04 05:55:27', NULL, NULL);
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (6, 'manual', 551, 'anual', 66, NULL, NULL, 20, '2023-05-04 05:57:40', '2023-05-04 05:57:40', NULL, NULL);
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (7, 'manual', 101, 'mensual', 43, 1, NULL, 20, '2023-05-04 06:00:38', '2023-05-04 06:00:38', NULL, NULL);
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (26, 'qr', 742, 'mensual', 33, 1, NULL, 5, '2023-05-26 08:35:37', '2023-05-26 08:35:37', NULL, NULL);
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (27, 'qr', 148, 'mensual', 198, 6, NULL, 5, '2023-05-26 08:37:59', '2023-05-26 08:37:59', NULL, NULL);
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (28, 'qr', 659, 'anual', 46, NULL, NULL, 5, '2023-05-26 08:39:31', '2023-05-26 08:39:31', NULL, 'comprobante/1685090371.jpeg');
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (29, 'qr', 659, 'anual', 46, NULL, NULL, 5, '2023-05-26 08:41:03', '2023-05-26 08:41:03', NULL, 'comprobante/1685090463.jpeg');
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (30, 'qr', 659, 'anual', 46, NULL, NULL, 5, '2023-05-26 08:41:07', '2023-05-26 08:41:07', NULL, 'comprobante/1685090467.jpeg');
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (31, 'qr', 659, 'anual', 46, NULL, NULL, 5, '2023-05-26 08:41:31', '2023-05-26 08:41:31', NULL, 'comprobante/1685090491.jpeg');
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (32, 'qr', 659, 'anual', 46, NULL, NULL, 5, '2023-05-26 08:41:59', '2023-05-26 08:41:59', NULL, 'comprobante/1685090519.jpeg');
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (33, 'qr', 257, 'mensual', 363, 11, NULL, 5, '2023-05-26 08:42:05', '2023-05-26 08:42:05', NULL, 'comprobante/1685090525.jpeg');
INSERT INTO public.payments (id, type, number, plan, amount, count, is_active, user_id, created_at, updated_at, status, comprobante) VALUES (34, 'qr', 2134, 'anual', 46, NULL, NULL, 5, '2023-05-26 08:43:42', '2023-05-26 08:43:42', NULL, 'comprobante/1685090622.jpeg');


--
-- Data for Name: request_forms; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.request_forms (id, user_id, vehicle_id, created_at, updated_at, parking_id, announcement_id) VALUES (6, 24, NULL, '2023-06-02 03:44:40', '2023-06-02 03:44:40', NULL, 2);
INSERT INTO public.request_forms (id, user_id, vehicle_id, created_at, updated_at, parking_id, announcement_id) VALUES (7, 25, NULL, '2023-06-02 03:45:21', '2023-06-02 03:45:21', NULL, 2);


--
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.rol (id, nom_role, horario_id, dia_trabajo_id, created_at, updated_at) VALUES (1, 'ADMINISTRADOR', NULL, NULL, NULL, NULL);
INSERT INTO public.rol (id, nom_role, horario_id, dia_trabajo_id, created_at, updated_at) VALUES (2, 'CLIENTE', NULL, NULL, NULL, NULL);
INSERT INTO public.rol (id, nom_role, horario_id, dia_trabajo_id, created_at, updated_at) VALUES (3, 'EMPLEADO', NULL, NULL, NULL, NULL);
INSERT INTO public.rol (id, nom_role, horario_id, dia_trabajo_id, created_at, updated_at) VALUES (4, 'PROVIDER', NULL, NULL, NULL, NULL);
INSERT INTO public.rol (id, nom_role, horario_id, dia_trabajo_id, created_at, updated_at) VALUES (5, 'PARQUERO', NULL, NULL, NULL, NULL);
INSERT INTO public.rol (id, nom_role, horario_id, dia_trabajo_id, created_at, updated_at) VALUES (6, 'GUARDIA', NULL, NULL, NULL, NULL);


--
-- Data for Name: unidades; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.unidades (id, nom_unidad, created_at, updated_at) VALUES (1, 'ing sistemas', NULL, NULL);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (1, 'Minerva Gill', 'admin@gmail.com', NULL, '$2y$10$EJ10FGgkE344xmGJu3aqbuVC1nxA0W9726aeH/fYuyI2Iwoj17vtq', NULL, '2023-04-14 03:20:44', '2023-04-14 03:20:44', 'Theodore Welch', NULL, 1, 1, 1);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (4, 'Joan Frederick', 'getixazahe@mailinator.com', NULL, '$2y$10$bnkz0ees0fwerDA8MDAO3.BdGyscJYnOI.Yvg7PFP/eFE8uZg.QQW', NULL, '2023-04-14 03:36:56', '2023-04-14 03:52:22', 'McKenzie Horne', '7869521', 1, 1, 2);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (5, 'Quin Kent', 'femivaqy@mailinator.com', NULL, '$2y$10$SJm80c8/h/Ueyl/5q1LVR.iGa.oAlMjirngkJdgRgvqfsSXU5BnIa', NULL, '2023-04-14 03:55:05', '2023-04-14 03:55:19', 'Garrison Mcdaniel', '213123', 1, 1, 2);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (6, 'Keelie Mccarthy', 'lamuje@mailinator.com', NULL, '$2y$10$Hheb6ayarH94JVeo0kfc9.RAgF6KbIcOexNEXsmP3pqYfrJUaM9/6', NULL, '2023-04-14 07:16:51', '2023-04-14 07:16:51', 'Carissa Lee', 'George Willis', 1, 1, 2);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (7, 'Aquila Pate', 'zimahy@mailinator.com', NULL, '$2y$10$bRl3I83wFR6PmnfWw1K/bu84eJ3XB0vG704sUQSHr./3CURzbzMhe', NULL, '2023-04-14 07:26:01', '2023-04-14 07:26:01', 'Jorden Garner', '415515555', 1, 1, 2);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (14, 'Elliott Burke', 'nipiqeqyk@mailinator.com', NULL, '$2y$10$3uWnsU/NFFUnZ3qO.SyBFe66QgKy5qogcj1tzDiXTfIbXn3G.tHJK', NULL, '2023-04-14 08:07:33', '2023-04-14 08:07:33', 'Shea Howe', 'Winifred Munoz', 1, 1, NULL);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (17, 'Lee Hart', 'cefebyv@mailinator.com', NULL, '$2y$10$PF.CV0s7Ez8C19ehF2KPIeDQrnH6I/xrKblW.nbBPgmmDPzqcWdUO', NULL, '2023-04-14 08:16:59', '2023-04-14 08:30:13', 'Seth Montgomery', 'Rhiannon Marquez', 1, 1, 3);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (18, 'Priscilla Ross', 'gixo@mailinator.com', NULL, '$2y$10$bdFiQCbykkA8h0ct1wsmJ.eKmN0ocCaJ2rqJzSNt8kdWHpUdybjKy', NULL, '2023-04-14 08:30:36', '2023-04-14 08:30:36', 'Ila Hill', 'Emerson Mcneil', 1, 1, 3);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (19, 'Jada Rush', 'kagesufy@mailinator.com', NULL, '$2y$10$ygYEP3gH6jRJOEdccY8kMeV48W9J4YTs7ZFvZtrc77Owr3.FOpThu', NULL, '2023-05-02 02:12:00', '2023-05-02 02:12:00', 'Chester Huber', '78465213', 1, 1, 2);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (20, 'Ruth Ortega', 'soqijerugu@mailinator.com', NULL, '$2y$10$xn5IWnBdHQPyHMzhb7IjNeLFBKRHlkkNQMObMLZkL.G5z4VQxVDHC', NULL, '2023-05-03 00:48:26', '2023-05-03 00:48:26', 'Rahim Mathews', '903213243', 1, 1, 2);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (21, 'test prvider', 'provider@gmail.com', NULL, '$2y$10$.GSR0sSW5PKlZotQdGgwS.Av4AamDMamaAVsq3qLjOkJO5YMt.5fm', NULL, '2023-05-04 05:06:48', '2023-05-04 05:06:48', '888888888', '777777777', 1, 1, 4);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (22, 'Buffy Duncan', 'empleado@gmail.com', NULL, '$2y$10$v4KhAe7nMvaYAZ5dCh2z9u4N0qDqg1PH/tMePKX0zg8WteCXd9IH.', NULL, '2023-05-18 06:05:41', '2023-05-18 06:05:41', '116664', '77777777', 1, 1, 5);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (23, 'Cathleen Tanner', 'guardia@gmail.com', NULL, '$2y$10$Yl.yx.ZjJZF2MVwlVxfz/OPRvN1xOq9eV1Vyf3Vn0YcA6Os3n3Otm', NULL, '2023-06-02 03:03:28', '2023-06-02 03:03:28', 'August Mccarty', 'Idona Hicks', 1, 1, 6);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (24, 'Isabelle Wade', 'empleado22@gmail.com', NULL, '$2y$10$Z5zRrGYJ4QHhuWlYbagrguaGW4JQyn6uQ3m.LZYkYPKwE8nIRYEUi', NULL, '2023-06-02 03:23:42', '2023-06-02 03:23:42', '5465646', '554654654', 1, 1, 2);
INSERT INTO public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, ci, celular, cargo_id, unidad_id, rol_id) VALUES (25, 'Sean Dunlap', 'cabuderoz@mailinator.com', NULL, '$2y$10$IalFmT585mhljCBQ8yHUWelFKm40l4EUMgHYOfT1tcTh1AgSF6SDK', NULL, '2023-06-02 03:45:16', '2023-06-02 03:45:16', '49989888', '416116161', 1, 1, 2);


--
-- Data for Name: vehicles; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.vehicles (id, user_id, placa, marca, modelo, plan_pago, image, created_at, updated_at, hour_vehicle_id) VALUES (6, 19, '1234', 'toyota', 'tets', NULL, 'vehicles/1683439193.jpeg', '2023-05-07 05:59:53', '2023-06-02 03:15:30', 9);


--
-- Name: announcements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.announcements_id_seq', 2, true);


--
-- Name: cargos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cargos_id_seq', 1, false);


--
-- Name: claim_managers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.claim_managers_id_seq', 1, false);


--
-- Name: claims_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.claims_id_seq', 20, true);


--
-- Name: conversation_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.conversation_messages_id_seq', 17, true);


--
-- Name: conversations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.conversations_id_seq', 9, true);


--
-- Name: dias_trabajo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dias_trabajo_id_seq', 1, false);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: horarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.horarios_id_seq', 11, true);


--
-- Name: income_vehicles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.income_vehicles_id_seq', 9, true);


--
-- Name: messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.messages_id_seq', 63, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 45, true);


--
-- Name: parkings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.parkings_id_seq', 100, true);


--
-- Name: payments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.payments_id_seq', 34, true);


--
-- Name: request_forms_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.request_forms_id_seq', 7, true);


--
-- Name: rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rol_id_seq', 1, false);


--
-- Name: unidades_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.unidades_id_seq', 1, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 25, true);


--
-- Name: vehicles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vehicles_id_seq', 6, true);


--
-- Name: announcements announcements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.announcements
    ADD CONSTRAINT announcements_pkey PRIMARY KEY (id);


--
-- Name: cargos cargos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cargos
    ADD CONSTRAINT cargos_pkey PRIMARY KEY (id);


--
-- Name: claim_managers claim_managers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.claim_managers
    ADD CONSTRAINT claim_managers_pkey PRIMARY KEY (id);


--
-- Name: claims claims_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.claims
    ADD CONSTRAINT claims_pkey PRIMARY KEY (id);


--
-- Name: conversation_messages conversation_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conversation_messages
    ADD CONSTRAINT conversation_messages_pkey PRIMARY KEY (id);


--
-- Name: conversations conversations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conversations
    ADD CONSTRAINT conversations_pkey PRIMARY KEY (id);


--
-- Name: dias_trabajo dias_trabajo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dias_trabajo
    ADD CONSTRAINT dias_trabajo_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: horarios horarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.horarios
    ADD CONSTRAINT horarios_pkey PRIMARY KEY (id);


--
-- Name: income_vehicles income_vehicles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.income_vehicles
    ADD CONSTRAINT income_vehicles_pkey PRIMARY KEY (id);


--
-- Name: messages messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.messages
    ADD CONSTRAINT messages_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: parkings parkings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parkings
    ADD CONSTRAINT parkings_pkey PRIMARY KEY (id);


--
-- Name: payments payments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_pkey PRIMARY KEY (id);


--
-- Name: request_forms request_forms_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.request_forms
    ADD CONSTRAINT request_forms_pkey PRIMARY KEY (id);


--
-- Name: rol rol_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (id);


--
-- Name: unidades unidades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidades
    ADD CONSTRAINT unidades_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: vehicles vehicles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vehicles
    ADD CONSTRAINT vehicles_pkey PRIMARY KEY (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: claim_managers claim_managers_claim_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.claim_managers
    ADD CONSTRAINT claim_managers_claim_id_foreign FOREIGN KEY (claim_id) REFERENCES public.claims(id) ON DELETE CASCADE;


--
-- Name: claim_managers claim_managers_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.claim_managers
    ADD CONSTRAINT claim_managers_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: claims claims_client_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.claims
    ADD CONSTRAINT claims_client_id_foreign FOREIGN KEY (client_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: conversation_messages conversation_messages_conversation_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conversation_messages
    ADD CONSTRAINT conversation_messages_conversation_id_foreign FOREIGN KEY (conversation_id) REFERENCES public.conversations(id) ON DELETE CASCADE;


--
-- Name: conversation_messages conversation_messages_receiver_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conversation_messages
    ADD CONSTRAINT conversation_messages_receiver_id_foreign FOREIGN KEY (receiver_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: conversation_messages conversation_messages_sender_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conversation_messages
    ADD CONSTRAINT conversation_messages_sender_id_foreign FOREIGN KEY (sender_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: conversations conversations_receiver_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conversations
    ADD CONSTRAINT conversations_receiver_id_foreign FOREIGN KEY (receiver_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: conversations conversations_sender_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.conversations
    ADD CONSTRAINT conversations_sender_id_foreign FOREIGN KEY (sender_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: income_vehicles income_vehicles_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.income_vehicles
    ADD CONSTRAINT income_vehicles_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: income_vehicles income_vehicles_vehicle_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.income_vehicles
    ADD CONSTRAINT income_vehicles_vehicle_id_foreign FOREIGN KEY (vehicle_id) REFERENCES public.vehicles(id) ON DELETE CASCADE;


--
-- Name: messages messages_claim_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.messages
    ADD CONSTRAINT messages_claim_id_foreign FOREIGN KEY (claim_id) REFERENCES public.claims(id) ON DELETE CASCADE;


--
-- Name: messages messages_sender_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.messages
    ADD CONSTRAINT messages_sender_id_foreign FOREIGN KEY (sender_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: payments payments_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: request_forms request_forms_announcement_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.request_forms
    ADD CONSTRAINT request_forms_announcement_id_foreign FOREIGN KEY (announcement_id) REFERENCES public.announcements(id) ON DELETE CASCADE;


--
-- Name: request_forms request_forms_parking_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.request_forms
    ADD CONSTRAINT request_forms_parking_id_foreign FOREIGN KEY (parking_id) REFERENCES public.parkings(id) ON DELETE CASCADE;


--
-- Name: request_forms request_forms_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.request_forms
    ADD CONSTRAINT request_forms_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: request_forms request_forms_vehicle_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.request_forms
    ADD CONSTRAINT request_forms_vehicle_id_foreign FOREIGN KEY (vehicle_id) REFERENCES public.vehicles(id) ON DELETE CASCADE;


--
-- Name: rol rol_dia_trabajo_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol
    ADD CONSTRAINT rol_dia_trabajo_id_foreign FOREIGN KEY (dia_trabajo_id) REFERENCES public.dias_trabajo(id) ON DELETE CASCADE;


--
-- Name: rol rol_horario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol
    ADD CONSTRAINT rol_horario_id_foreign FOREIGN KEY (horario_id) REFERENCES public.horarios(id) ON DELETE CASCADE;


--
-- Name: users users_cargo_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_cargo_id_foreign FOREIGN KEY (cargo_id) REFERENCES public.cargos(id) ON DELETE CASCADE;


--
-- Name: users users_rol_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_rol_id_foreign FOREIGN KEY (rol_id) REFERENCES public.rol(id) ON DELETE CASCADE;


--
-- Name: users users_unidad_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_unidad_id_foreign FOREIGN KEY (unidad_id) REFERENCES public.unidades(id) ON DELETE CASCADE;


--
-- Name: vehicles vehicles_hour_vehicle_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vehicles
    ADD CONSTRAINT vehicles_hour_vehicle_id_foreign FOREIGN KEY (hour_vehicle_id) REFERENCES public.income_vehicles(id) ON DELETE CASCADE;


--
-- Name: vehicles vehicles_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vehicles
    ADD CONSTRAINT vehicles_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

